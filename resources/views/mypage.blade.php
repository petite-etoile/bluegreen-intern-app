@extends('template')
@include('head')
@include('header')
@include('footer')

@section('content')

<h3 style="height:30px; margin-bottom:30px;">
    Mypage
</h3>


ユーザ情報

<table style="text-align:center;" class="table table-striped table-bordered">
    <tbody>
        <tr>
            <th scope="row">ユーザ名</th>
            <form action="/edit-name" method="POST">
                @csrf
                @method('PATCH')
                <td>
                    <input name="name" value="{{ $me->name }}" class="form-cell"></input>
                </td>
                <td><button class="btn text-primary" style="width:100%;">更新</button></td>
            </form>
        </tr>
        <tr>
            <th scope="row">メールアドレス</th>
            <form action="/edit-email" method="POST">
                @csrf
                @method('PATCH')
                <td>
                    <input name="email" value="{{ $me->email }}" class="form-cell"></input>
                </td>
                <td><button class="btn text-primary" style="width:100%;">更新</button></td>
            </form>
        </tr>
        <tr>
            <th scope="row">自己紹介</th>
            <form action="/edit-introduction" method="POST">
                @csrf
                @method('PATCH')
                <td>
                    <textarea name="introduction" rows="3" style="font-size:large !important;" class="form-cell">{{ $me->introduction }}</textarea>
                </td>
                <td><button class="btn text-primary" style="width:100%;">更新</button></td>
            </form>
        </tr>
    </tbody>
</table>


<form action="/delete-me" method="POST">
    @csrf
    <input type="hidden" name="_method" value="DELETE"> <!-- for setting method DELETE -->
    <br>
    <button class="btn btn-danger float-right clear"> アカウントを削除 </button>
</form>

@endsection