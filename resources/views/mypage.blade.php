@extends('template')
@include('head')
@include('header')
@include('footer')

@section('content')

Mypage <br>
id: {{ $me }}

@endsection