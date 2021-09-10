@extends('template')
@include('head')
@include('header')
@include('footer')

@section('content')

<div class="container">
    <h2>ツイートを入力</h2>
    <form action="/tweet-form" method="POST" class="form-group">
        @csrf
        <textarea class="form-control" name="tweet_text" rows="4" cols="40" placeholder="ねぇ今どんな気持ち？"></textarea>
        <br>
        <button class="btn btn-primary float-right w-25"> 送信 </button>
    </form>
</div>

@endsection
    </body>
</html>
