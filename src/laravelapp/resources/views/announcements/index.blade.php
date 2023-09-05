@extends('layouts.common')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>お知らせ一覧</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">お知らせ一覧</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            @foreach($announcements as $announcement)
            <div class="col-md-12">
                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h3 class="card-title">
                            <!-- 詳細ページへのリンクを追加 -->
                            <a href="{{ route('announcements.show', ['id' => $announcement->id]) }}">
                                {{ $announcement->title }}
                            </a>
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        {!! Str::limit($announcement->content, 100) !!}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection