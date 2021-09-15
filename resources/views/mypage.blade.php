@extends('template')
@include('head')
@include('header')
@include('footer')

@section('content')

<h3 style="height:30px; margin-bottom:30px;">
    Mypage
</h3>


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
</form>
<button class="btn btn-primary w-25 float-right" style="width:100%;">更新</button>

<div style="height:100px;"></div>


<form action="/delete-me" method="POST">
    @csrf
    <input type="hidden" name="_method" value="DELETE"> <!-- for setting method DELETE -->
    <br>
    <button class="btn btn-danger float-right clear"> アカウントを削除 </button>
</form>

@endsection