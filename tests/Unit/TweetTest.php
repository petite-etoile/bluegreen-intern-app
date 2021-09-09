<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Tweet;
use App\Http\Services\TweetService;

class TweetTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_saving_tweet()
    {
        //テスト用データの用意
        $tweet = Tweet::factory()->make();
        $tweet_text = $tweet->tweet_text;
        $user_id = $tweet->user_id;


        //ツイートが保存されたか(DBのレコードが増えたか)
        $record_num_before = Tweet::count();

        $created_tweet = TweetService::create_tweet([
            'tweet_text' => $tweet_text,
            'user_id' => $user_id,
        ]);

        $record_num_after = Tweet::count();
        $this->assertSame($record_num_before + 1, $record_num_after);

        //正しいデータが保存されたか
        $saved_tweet = Tweet::find( $created_tweet->id );
        $this->assertSame($saved_tweet->tweet_text, $tweet_text);
        $this->assertSame($saved_tweet->user_id, $user_id);

    }   
}
