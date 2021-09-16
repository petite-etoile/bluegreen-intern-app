<?php

namespace App\Http\Services;

use App\Models\Tweet;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class TweetService{

    /**
     *  user_idのツイートとしてtweet_textをDBに保存する
     *
     *  @param array $request tweet_textとuser_idをもつ連想配列
     *  @return object 作成したツイート
     */
    public static function create_tweet(array $request):object
    {
        $tweet = Tweet::create([
            'tweet_text' => $request['tweet_text'],
            'user_id' => $request['user_id'],
        ]);

        return $tweet;
    }

    /**
     *  ツイートがuser_idのものなら, DBから削除する.
     *
     *  @param array $request idとuser_idをもつ連想配列
     *  @return void 削除したツイート
     */
    public static function delete_tweet(array $request):void
    {
        $tweet = Tweet::find($request['id']);
        if($tweet && $tweet->user_id==$request['user_id']){
            $tweet->delete();
        }
    }

    public const GET_MAX_TWEET_NUM = 10; //1ページの表示ツイート数上限

    /**
     *  このpageを表示するツイートを新しい順の配列で返す.
     *
     *  表示するツイート
     *       - user_idがフォローしているユーザのツイート
     *
     *  @param array $request user_idとpageをもつ連想配列
     *  @return object フォロイーのツイート(ツイーターの名前をつけて)
     */
    public static function get_tweets_at_page(array $request):object
    {
        $skip_tweet_cnt = self::GET_MAX_TWEET_NUM * ($request['page'] - 1); //offsetする数

        return $tweets = DB::table('tweets')
            ->join('follows', function ($join) use ($request){
                $join->on('tweets.user_id', '=', 'follows.followed_user_id')
                    ->where('follows.following_user_id', '=', $request['user_id']);
            })
            ->join('users', 'tweets.user_id', '=', 'users.id')
            ->orderBy('tweets.created_at', 'desc')
            ->skip($skip_tweet_cnt)
            ->take(self::GET_MAX_TWEET_NUM)
            ->select('tweets.id', 'tweets.tweet_text','tweets.user_id','users.name','tweets.created_at')
            ->get();

    }

    /**
     *  ホームに表示されるツイートが何ページ数に分かれるかを求める.
     *
     *  表示するツイート
     *       - user_idがフォローしているユーザのツイート
     *
     *  @param array $request user_idをもつ連想配列
     *  @return int ホームに表示されるページ総数
     */
    public static function get_page_num(array $request):int
    {
        $tweet_count = DB::table('tweets')
            ->join('follows', function ($join) use ($request){
                $join->on('tweets.user_id', '=', 'follows.followed_user_id')
                    ->where('follows.following_user_id', '=', $request['user_id']);
            })
            ->count();

        return (int)(($tweet_count + self::GET_MAX_TWEET_NUM - 1) / self::GET_MAX_TWEET_NUM);
    }

}
