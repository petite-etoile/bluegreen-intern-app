@extends('template')
@include('head')
@include('header')
@include('footer')

@section('content')

ユーザ一覧

<div class="mb-3"></div>

<div>
    @foreach ($users as $user)
        @if ($loop->index % 3 == 0)
            <div class="clear"></div>
        @endif
        <div class="user-cell">
            <a class="user-name" href="/user/{{ $user->id }}">{{ $user->name }}</a>
            <form action="/follow" method="POST">
                @csrf
                <button class="follow-btn"> フォロー </button>
            </form>
        </div>
    @endforeach
</div>
<div class="clear"></div>

@endsection
