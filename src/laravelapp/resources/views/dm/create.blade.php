@extends('layouts.common')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>DM</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">DM</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>


<div class="container">
    <h1>DM掲示板</h1>

    <!-- 送信フォーム -->
    <form method="POST" action="{{ route('dm.store') }}">
        @csrf
        <div class="form-group">
            <label for="content">DM内容:</label>
            <textarea name="content" id="content" class="form-control" required></textarea>
        </div>

        <!-- 案件のIDをフォームに含める -->
        <input type="hidden" name="job_id" value="{{ $job->id }}">

        <button type="submit" class="btn btn-primary">送信</button>
    </form>

    <!-- 送信されたDMの一覧を表示 -->
    <div class="mt-4">
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <h2>送信されたDM一覧</h2>
        <ul>
            @foreach($dms as $dm)
            <li>{{ $dm->content }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endsection