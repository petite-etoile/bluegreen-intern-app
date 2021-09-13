<?php

namespace App\Http\Services;

use App\Models\Tweet;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class UserService{

    // 引数
    //      user_idをもつ連想配列
    // 動作
    //      user_idの情報を返す
    //        - Userテーブルの情報
    //        - Tweetテーブルの情報
    public static function get_info_about_user($request){
        $user = DB::table('tweets')
        ->join('follows', function ($join) use ($request){
            $join->on('tweets.user_id', '=', 'follows.followed_user_id')
                ->where('follows.following_user_id', '=', $request['user_id']);
        })
        ->join('tweets', 'users.id', '=', 'tweets.user_id')
        ->orderBy('tweets.id')
        ->get();

        return $user;

    }
}
