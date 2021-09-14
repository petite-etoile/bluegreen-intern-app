<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Tweet;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Services\UserService;
use App\Http\Services\FollowService;


class UserController extends Controller
{

    public function mypage(){
        $me = User::find(Auth::id());
        return view('mypage', ['me' => $me, 'path' => 'mypage']);
    }

    public function show(){
        $users = UserService::users_with_follow_info(Auth::id());
        return view('user_list', ['path' => 'user-list', 'users' => $users]);
    }

    public function userpage($user_id){
        $user = User::find($user_id);
        $is_following = FollowService::is_following([
            'following_user_id' => Auth::id(),
            'followed_user_id' => $user_id,
        ]);

        return view('user_page', [
            'user' => $user,
            'path' => 'userpage',
            'is_following' => $is_following,
        ]);
    }

}
