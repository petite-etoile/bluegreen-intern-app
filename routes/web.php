<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TweetController;
use App\Http\Controllers\UserController;
 use App\Http\Controllers\FollowController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('/tweet-form', function () {
        return view('tweet_form', ['path' => 'tweet-form']);
    });

    Route::post('/tweet-form', [TweetController::class, 'add']);

    Route::get('/delete-form', function () {
        return view('delete_form');
    });

    Route::delete('/delete-form', [TweetController::class, 'delete']);

    Route::get('/dashboard', function () {
        return redirect('/home');
    });

    Route::get('/home/{page?}', [TweetController::class, 'index'] );

    Route::get('/mypage', [UserController::class, 'mypage']);

    Route::get('/user-list', [UserController::class, 'show']);

    Route::get('/user/{id?}', [UserController::class, 'userpage']);

    Route::post('/follow', [FollowController::class, 'add']);

    Route::post('/unfollow', [FollowController::class, 'delete']);

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
  
    Route::patch('/edit-user-info', [UserController::class, 'edit_user_info']);

});


require __DIR__.'/auth.php';
