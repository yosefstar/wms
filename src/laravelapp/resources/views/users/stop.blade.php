<!-- resources/views/users/stop.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h2>ユーザーアカウントを停止</h2>
    <p><strong>ユーザーID:</strong> {{ $user->id }}</p>
    <p><strong>名前:</strong> {{ $user->user_name }}</p>
    <p><strong>アイコン:</strong>
        @if($user->user_icon)
        <img src="{{ $user->user_icon }}" alt="アイコン" style="max-height: 100px; max-width: 100px;">
        @else
        No Image
        @endif
    </p>
    <p><strong>ニックネーム:</strong> {{ $user->user_nickname }}</p>
    <p><strong>登録日時:</strong> {{ $user->created_at }}</p>

    <form method="POST" action="{{ route('users.stop', $user->id) }}">
        @csrf
        @method('PUT')
        <button type="submit" class="btn btn-danger">アカウントを停止</button>
    </form>
</div>
@endsection