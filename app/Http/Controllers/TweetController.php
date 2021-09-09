<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tweet;
use Illuminate\Support\Facades\DB;

class TweetController extends Controller
{

    //ツイートを作成し, Homeにリダイレクトさせる
    public function add(Request $request){
        
        $tweet = Tweet::create([
            'tweet_text' => $request->tweet_text,
            'user_id' => Auth::id(),
        ]);


        // FIX ME
        //
        // /home を作成したら, そこにリダイレクトさせる
        return redirect('/tweet-form'); 
    }

    //ツイートを削除し, Homeにリダイレクトさせる
    public function delete(Request $request){
        
        $tweet = Tweet::find( $request->id );
        $tweet->delete();

        return $request->id;
        // FIX ME
        //
        // /home を作成したら, そこにリダイレクトさせる
        // return redirect('/dashboard'); 
    }
}
