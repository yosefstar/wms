<!-- resources/views/users/index.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h2>ユーザー一覧</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ユーザーID</th>
                <th>名前</th>
                <th>アイコン</th>
                <th>ニックネーム</th>
                <th>登録日時</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->user_name }}</td>
                <td>
                    @if($user->user_icon)
                    <img src="{{ $user->user_icon }}" alt="アイコン" style="max-height: 50px; max-width: 50px;">
                    @else
                    No Image
                    @endif
                </td>
                <td>{{ $user->user_nickname }}</td>
                <td>{{ $user->created_at }}</td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection