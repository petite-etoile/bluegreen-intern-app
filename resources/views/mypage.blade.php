@extends('template')
@include('head')
@include('header')
@include('footer')

@section('content')

<h3 style="height:30px; float:left;">
    Mypage
</h3>

<form action="/delete-me" method="POST">
    @csrf
    <input type="hidden" name="_method" value="DELETE"> <!-- for setting method DELETE -->
    <button class="btn btn-danger float-right clear"> アカウントを削除 </button>
</form>

<div style="height:50px;"></div>

ユーザ情報
<form action="/edit-user-info" method="POST">
    @csrf
    @method('PATCH')

    <table style="text-align:center;" class="table table-striped table-bordered">
        <tbody>
            <tr>
                <th scope="row">ユーザ名</th>
                <td>
                    <input name="name" value="{{ $me->name }}" class="form-cell"></input>
                </td>
            </tr>
            <tr>
                <th scope="row">メールアドレス</th>
                <td>
                    <input name="email" value="{{ $me->email }}" class="form-cell"></input>
                </td>
            </tr>
            <tr>
                <th scope="row">自己紹介</th>
                <td>
                    <textarea name="introduction" rows="3" style="font-size:large !important;" class="form-cell">{{ $me->introduction }}</textarea>
                </td>
            </tr>
        </tbody>
    </table>
    <button class="btn btn-primary w-25 float-right" style="width:100%;">更新</button>
</form>

<div style="height:100px;"></div>


<div class="tweet-table">
    @forelse ($me->tweets()->orderBy('created_at', 'desc')->get() as $tweet)
        <div class="tweet-cell">
            <a href="/user/{{ $tweet->user_id }}" class="tweeter">{{ $me->name }}</a>
            <div class="tweet-date">{{ $tweet->created_at }}</div>
            <div class="tweet-text clear">{{ $tweet->tweet_text }}</div>
            <form action="/delete-form" method="POST" style="float-right">
                @csrf
                <input type="hidden" name="_method" value="DELETE"> <!-- for setting method DELETE -->
                <input type="hidden" name="id" value="{{ $tweet->id }}">
                <button class="tweet-delete-btn btn btn-sm btn-danger"> 削除 </button>
            </form>
            <div class="clear"></div>
        </div>
    @empty
        <p style="margin-top:50px; font-size:30px;"> まだツイートがありません. </p>
    @endforelse
</div class="tweet-table">

@endsection