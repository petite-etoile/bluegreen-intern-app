<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tweet;
use App\Models\User;
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


        return redirect('/home');
    }

    //ツイートを削除し, Homeにリダイレクトさせる
    public function delete(Request $request){

        $tweet = TweetService::delete_tweet([
            'id' => $request->id,
            'user_id' => Auth::id(),
        ]);

        return redirect('/home');
    }

    //ホームでフォロイーのツイートを表示する
    public function index($page = '1'){

        $tweets = TweetService::get_tweets_at_page([
            'user_id' => Auth::id(),
            'page' => $page,
        ]);

        $page_num = TweetService::get_page_num([
            'user_id' => Auth::id(),
        ]);

        $tweets_with_name = TweetService::attach_name_to_tweets([
            'tweets' => $tweets,
        ]);

        return view('home', [
            'page' => $page,
            'path' => 'home',
            'tweets'=>$tweets_with_name,
            'page_num' => $page_num
        ]);
    }

    public function mypage(){

        $me = User::find(Auth::id());
        return view('mypage', ['me' => $me, 'path' => 'mypage']);
    }

}
