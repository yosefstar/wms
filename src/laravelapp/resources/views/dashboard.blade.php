@extends('layouts.common')

@section('content')

<div class="wrapper">
    <!-- <div class="content-wrapper"> -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>ダッシュボード</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="./dashboard">Home</a></li>
                        <li class="breadcrumb-item active">ダッシュボード</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
</div>

@if(Auth::user()->user_type == 1)
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">未完了の案件数</h5>
                <p class="card-text"></p>
                <a href="{{ route('jobs.index') }}" class="card-link">{{ $ongoingJobCount }}件</a>
            </div>
        </div>
    </div>
</div>
@else
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
@endsection