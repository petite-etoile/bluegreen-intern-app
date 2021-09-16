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
    public static function get_follow_users($user_id):object
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

    /**
     *  ユーザ名, メールアドレス, 自己紹介文を変更する
     *
     *  @param array user_idとnameを持つ連想配列
     *  @return void
     */
    public static function edit_user_info($request):void
    {
        $user = User::find($request['user_id']);
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->introduction = $request['introduction'];
        $user->save();
    }

    /**
     *  ユーザ名, メールアドレス, 自己紹介文を変更する
     *
     *  @param integer user_id 削除するユーザのID
     *  @return void
     */
    public static function delete_user($user_id):void
    {
        User::find($user_id)->delete();
    }

    public static function update_password($request):void
    {
        $user = User::find($request['user_id']);
        $user->password = bcrypt($request['new_password']);
        $user->save();
    }
}
