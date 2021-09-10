@extends('template')
@include('head')
@include('header')
@include('footer')

@section('content')

ツイートを表示({{ $page }}ページ目)

<div class="tweet-table">
    @forelse ($tweets as $tweet)
        <div class="tweet-cell">
            <a href="/user/{{ $tweet->user_id }}" class="tweeter">{{ $tweet->user_id }}</a>
            <div class="tweet-text">{{ $tweet->tweet_text }}</div>
            <div class="tweet-date">{{ $tweet->created_at }}</div>
        </div>
    @empty
        <p style="margin-top:50px; font-size:30px;"> フォロイーのツイートがありません. <a class="link" href="/user-list">こちら</a>でフォローしましょう！ </p>
    @endforelse
</div class="tweet-table">

<div class="mt-3"></div>

@for ($i = 1; $i < $page_num ; $i++)
    <a class="pt-1 page-btn {{ $i==$page ? 'page-btn-active' : ''}}" href="/home/{{ $i }}">
        {{ $i }}
    </a>
@endfor
<div>

</div>

@endsection

