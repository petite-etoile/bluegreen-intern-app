@extends('template')
@include('head')
@include('header')
@include('footer')

@section('content')

<div style="height:30px; padding:0 30px;">
    <div class="float-left">
        {{ $user->name }}のページ
    </div>

    @if ($is_following)
        <div class="unfollow-btn">
            アンフォロー
        </div>
    @else
        <div class="follow-btn">
            フォロー
        </div>
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
