@extends('layouts.app')

@section('content')
<div class="container">
    <h2>ユーザー一覧</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>ユーザー名</th>
                <th>アイコン</th>
                <th>ニックネーム</th>
                <th>作成日時</th>
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
                <td>
                    <a href="{{ route('users.show', $user->id) }}">詳細</a>
                    <a href="{{ route('users.edit', $user->id) }}">編集</a>
                    <a href="{{ route('users.stop', $user->id) }}">停止</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection