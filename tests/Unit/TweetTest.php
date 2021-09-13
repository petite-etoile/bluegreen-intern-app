<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Tweet;
use App\Models\User;
use App\Models\Follow;
use App\Http\Services\TweetService;
use Illuminate\Support\Facades\DB;

class TweetTest extends TestCase
{
    // use RefreshDatabase;
    /**
     * A unit test for saving tweet.
     *
     * @return void
     */
    public function test_saving_tweet(): void
    {
        // テスト用データの用意
        $tweet = Tweet::factory()->make();
        $tweet_text = $tweet->tweet_text;
        $user_id = $tweet->user_id;


        // ツイートが保存されたか(DBのレコードが増えたか)
        // 期待すること: DBのレコードが1増えている
        $record_num_before = Tweet::count();

        $created_tweet = TweetService::create_tweet([
            'tweet_text' => $tweet_text,
            'user_id' => $user_id,
        ]);

        $record_num_after = Tweet::count();
        $this->assertSame($record_num_before + 1, $record_num_after);

        // 正しいデータが保存されたか
        // 期待すること: 作られたツイートのデータとDBに保存されたデータが一致する
        $saved_tweet = Tweet::find( $created_tweet->id );
        $this->assertSame($saved_tweet->tweet_text, $tweet_text);
        $this->assertSame($saved_tweet->user_id, $user_id);

    }

    /**
     * A unit test for deleting tweet.
     *
     * @return void
     */
    public function test_deleting_tweet(): void
    {

        // テスト用データの用意
        $tweet = Tweet::factory()->create();
        $id = $tweet->id;
        $user_id = $tweet->user_id;

        // (他人が削除しようとしたら)
        // ツイートが削除されたか
        // 期待すること: レコードの数が減っていない
        $record_num_before = Tweet::count();

        $deleted_tweet = TweetService::delete_tweet([
            'id' => $id,
            'user_id' => $user_id+1,
        ]);

        $record_num_after = Tweet::count();
        $this->assertSame($record_num_before, $record_num_after);

        // (本人が削除しようとしたら)
        // ツイートが削除されたか
        // 期待すること: レコードの数が1減っている
        $record_num_before = Tweet::count();

        $deleted_tweet = TweetService::delete_tweet([
            'id' => $id,
            'user_id' => $user_id,
        ]);

        $record_num_after = Tweet::count();
        $this->assertSame($record_num_before - 1, $record_num_after);

        // 正しいデータが削除されたか
        // 期待すること: 削除したツイートのIDが, DBに存在しない
        $this->assertSame(Tweet::find( $deleted_tweet->id ), null);



        // 指定したIDが存在しなかったときに, エラーを吐かずに動作するか
        $deleted_tweet = TweetService::delete_tweet([
            'id' => $id,
        ]);

    }

    public const GET_MAX_TWEET_NUM = 10; //1ページの表示ツイート数上限

    /**
     * A unit test for listing tweets.
     *
     * @return void
     */
    public function test_listing_tweets(): void
    {
        $user = User::factory()->create();
        $user_id = $user->id;

        Follow::factory()->count(30)->create();
        Tweet::factory()->count(1000)->create();
        $followed_user_list = Follow::where('following_user_id', $user_id) -> get();

        $page = 2;
        $skip_tweet_cnt = self::GET_MAX_TWEET_NUM * ($page - 1); //offsetする数

        $tweets = DB::table('tweets')
            ->join('follows', function ($join) use ($user_id){
                $join->on('tweets.user_id', '=', 'follows.followed_user_id')
                    ->where('follows.following_user_id', '=', $user_id);
            })
            ->orderBy('id')
            ->get();


        $listed_tweet = TweetService::get_tweets_at_page([
            'user_id' => $user_id,
            'page' => $page,
        ]);

        for($idx=0; $idx<min(10, count($tweets) - $skip_tweet_cnt); $idx++){
            $this->assertSame($tweets[$idx + $skip_tweet_cnt]->id, $listed_tweet[$idx]->id);
        }
    }

    /**
     * A unit test for getting page num.
     *
     * @return void
     */
    public function test_getting_page_num(): void
    {
        $user_id = 1;
        $user = User::find($user_id);

        $followed_user_list = Follow::where('following_user_id', $user_id) -> get();

        $tweet_num = DB::table('tweets')
            ->join('follows', function ($join) use ($user_id){
                $join->on('tweets.user_id', '=', 'follows.followed_user_id')
                    ->where('follows.following_user_id', '=', $user_id);
            })
            ->count();

        $expected_page_num = ($tweet_num + self::GET_MAX_TWEET_NUM - 1) / self::GET_MAX_TWEET_NUM;

        $gotten_page_num = TweetService::get_page_num([
            'user_id' => $user_id,
        ]);

        $this->assertSame($expected_page_num, $gotten_page_num);
    }

}
