<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Tweet;
use App\Http\Services\TweetService;

class TweetTest extends TestCase
{
    /**
     * A unit test for saving tweet.
     *
     * @return void
     */
    public function test_saving_tweet()
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
    public function test_deleting_tweet()
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
}
