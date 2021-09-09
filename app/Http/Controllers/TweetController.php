<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tweet;
use Illuminate\Support\Facades\DB;
use App\Http\Services\TweetService;

class TweetController extends Controller
{

    //ツイートを作成し, Homeにリダイレクトさせる
    public function add(Request $request){

        $tweet = TweetService::create_tweet([
            'tweet_text' => $request->tweet_text, 
            'user_id' => Auth::id(),
        ]);


        // FIX ME
        //
        // /home を作成したら, そこにリダイレクトさせる
        return redirect('/tweet-form'); 
    }

}
