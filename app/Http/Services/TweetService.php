<?php

namespace App\Http\Services;

use App\Models\Tweet;

class TweetService{
    public static function create_tweet($request){
        $tweet = Tweet::create([
            'tweet_text' => $request['tweet_text'],
            'user_id' => $request['user_id'],    
        ]);   

        return $tweet;
    }

    public static function delete_tweet($request){
        $tweet = Tweet::find($request['id']);
        if($tweet && $tweet->user_id==$request['user_id']){
            $tweet->delete();
        }

        return $tweet;
    }
}