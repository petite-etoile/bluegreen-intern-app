@extends('template')
@include('head')
@include('header')
@include('footer')

@section('content')

<div style="height:30px; padding:0 30px;">
    <div class="float-left">
        {{ $user->name }}のページ
    </div>

    @if ($is_following == true)
        <form action="/unfollow" method="POST">
            @csrf
            <input type="hidden" name="user_id" value="{{ $user->id }}">
            <button class="unfollow-btn"> アンフォロー </button>
        </form>
    @else
        <form action="/follow" method="POST">
            @csrf
            <input type="hidden" name="user_id" value="{{ $user->id }}">
            <button class="follow-btn"> フォロー </button>
        </form>
    @endif
</div>

<div class="clear"></div>


<br>
<div class="tweet-table">
    @forelse ($user->tweets as $tweet)
        <div class="tweet-cell">
            <a href="/user/{{ $tweet->user_id }}" class="tweeter">{{ $tweet->name }}</a>
            <div class="tweet-date">{{ $tweet->created_at }}</div>
            <div class="tweet-text clear">{{ $tweet->tweet_text }}</div>
        </div>
    @empty
        <p style="margin-top:50px; font-size:30px;"> まだツイートがありません. </p>
    @endforelse
</div class="tweet-table">

@endsection
