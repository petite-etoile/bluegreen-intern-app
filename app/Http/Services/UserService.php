<?php

namespace App\Http\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;


class UserService{

    /**
     *  ユーザ情報にフォローしているかの情報をつけて返す
     *
     *  フォローしてない場合, followed_user_id をnullにする.
     *
     *  @param integer user_id
     *  @return object  ユーザ情報(id, name)にfollowed_user_idをつけて返す
     */
    public static function users_with_follow_info($user_id):object
    {
        return DB::table('users')
        ->leftjoin('follows', function ($join) use ($user_id){
            $join->on('users.id', '=', 'follows.followed_user_id')
                ->where('follows.following_user_id', '=', $user_id);
        })
        ->orderBy('users.id')
        ->select('users.id', 'users.name', 'follows.followed_user_id')
        ->get();
    }

}