<!-- resources/views/dashboard.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h2>ダッシュボード</h2>
    @if(Auth::user()->user_type == 1)
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">実施中の案件数</h5>
                    <p class="card-text">4件</p>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if(Auth::user()->user_type != 1)
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">管理者からのお知らせ</h5>
                    <p class="card-text">4件</p>
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="row mt-4">
        <div class="col-md-4">
            <div class="list-group">
                <a href="{{ route('projects.index') }}" class="list-group-item list-group-item-action">案件管理</a>
                <a href="{{ route('billing.index') }}" class="list-group-item list-group-item-action">請求管理</a>
                <a href="{{ route('announcements.index') }}" class="list-group-item list-group-item-action">お知らせ管理</a>
                <a href="{{ route('users.index') }}" class="list-group-item list-group-item-action">ユーザー管理</a>
                <!-- 他のメニューアイテムを追加 -->
            </div>
        </div>
    </div>
</div>
@endsection