<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Tweet;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Services\UserService;
use App\Http\Services\FollowService;
use App\Http\Requests\UpdatePasswordRequest;

class UserController extends Controller
{

    public function mypage(){
        $me = User::find(Auth::id());
        return view('mypage', ['me' => $me, 'path' => 'mypage']);
    }

    public function show(){
        $users = UserService::get_follow_users(Auth::id());
        return view('user_list', ['path' => 'user-list', 'users' => $users]);
    }

    public function find($user_id){
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

    public function edit_user_info(Request $request){
        UserService::edit_user_info([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'email' => $request->email,
            'introduction' => $request->introduction
        ]);

        return redirect(url()->previous());
    }

    public function edit_password(){
        return view('edit-password', ['path' => 'edit-password']);
    }

    public function update_password(UpdatePasswordRequest $request){
        $user = Auth::user();
        $user->password = bcrypt($request->new_password);
        $user->save();

        return redirect()->back()->with('update_password_success', 'パスワードを変更しました。');
    }

    public function delete(){
        $users = UserService::delete_user(Auth::id());
        return redirect('/');
    }

}
