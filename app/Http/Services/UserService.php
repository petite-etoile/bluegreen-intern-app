<?php

namespace App\Http\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;


class UserService{

    /**
     *  ユーザ名を変更する
     *
     *  @param array user_idとnameを持つ連想配列
     *  @return void
     */
    public static function edit_name($request){
        $user = User::find($request['user_id']);
        $user->name = $request['name'];
        $user->save();
    }

    /**
     *  メールアドレスを変更する
     *
     *  @param array user_idとemailを持つ連想配列
     *  @return void
     */
    public static function edit_email($request){
        $user = User::find($request['user_id']);
        $user->email = $request['email'];
        $user->save();
    }

    /**
     *  自己紹介文を変更する
     *
     *  @param array user_idとintroductionを持つ連想配列
     *  @return void
     */
    public static function edit_introduction($request){
        $user = User::find($request['user_id']);
        $user->introduction = $request['introduction'];
        $user->save();
    }

}
