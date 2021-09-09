<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tweet;

class TweetController extends Controller
{
    //ツイートを作成し, Homeにリダイレクトさせる
    public function add(Request $request){
        
        $tweet = new Tweet;
        $tweet->tweet_text = $request->tweet_text;
        $tweet->user_id = Auth::id();
        $tweet->root_tweet_id = Tweet::all()->count() + 1; 
        $tweet->save();

        // FIX ME
        //
        // /home を作成したら, そこにリダイレクトさせる
        return redirect('/dashboard'); 
    }
}
