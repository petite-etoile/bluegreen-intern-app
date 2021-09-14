<?php

namespace App\Http\Services;

use App\Models\Tweet;
use App\Models\User;
use App\Models\Follow;
use Illuminate\Support\Facades\DB;


class FollowService{

    // 引数
    //      following_user_idとfollowed_user_idを持つ連想配列
    // 動作
    //      following_user_id が followed_user_id をフォローしているかを返す(boolean)
    public static function is_following($request){
        $record_cnt = DB::table('follows')
        ->where([
            ['following_user_id', '=', $request['following_user_id']],
            ['followed_user_id', '=', $request['followed_user_id']]
        ])
        ->count();

        return $record_cnt >= 1;
    }
}
