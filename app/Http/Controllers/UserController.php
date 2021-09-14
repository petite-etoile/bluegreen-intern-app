<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Tweet;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Services\UserService;

class UserController extends Controller
{

    public function mypage(){
        $me = User::find(Auth::id());
        return view('mypage', ['me' => $me, 'path' => 'mypage']);
    }

    public function show(){
        $users = User::all();
        return view('user_list', ['path' => 'user-list', 'users' => $users]);
    }

    public function userpage($user_id){
        $user = User::find($user_id);
        return view('user_page', ['user' => $user, 'path' => 'userpage']);
    }

    public function edit_user_info(Request $request){
        UserService::edit_name([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'email' => $request->email,
            'introduction' => $request->introduction
        ]);

        return redirect(url()->previous());
    }

}
