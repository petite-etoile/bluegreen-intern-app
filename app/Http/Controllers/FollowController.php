<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FollowController extends Controller
{
    //フォローし, 前いたページにリダイレクトさせる
    public function add(Request $request){
        // $follow = FollowService::follow([
        //     'following_user_id' => Auth::id(),
        //     'followed_user_id' => Auth::id(),
        // ]);


        return redirect(url()->previous()); 
    }

    //アンフォローし, 前いたページにリダイレクトさせる
    public function delete(Request $request){
        // $follow = FollowService::unfollow([
        //     'following_user_id' => Auth::id(),
        //     'followed_user_id' => Auth::id(),
        // ]);

        return redirect(url()->previous()); 
    }
}
