<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TweetController;
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

    Route::post('/tweet-form', [TweetController::class, "add"]);

    Route::get('/delete-form', function () {
        return view('delete_form');
    });

    Route::delete('/delete-form', [TweetController::class, "delete"]);
    
    Route::get('/dashboard', function () {
        return redirect('/home/1');
    });

    Route::get('/home/{page?}', [TweetController::class, "index"] );

    Route::get('/mypage', function () {
        return view('mypage', ['path' => 'mypage']);
    });
    
    Route::get('/user-list', function () {
        return view('user_list', ['path' => 'user-list']);
    });

});




require __DIR__.'/auth.php';
