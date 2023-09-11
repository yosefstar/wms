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
<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-info">
        <div class="inner">
            <h3>{{ $ongoingJobCount }}件</h3>

            <p>未完了の案件数</p>
        </div>
        <div class="icon">
            <i class="ion">
                <ion-icon name="clipboard-outline"></ion-icon>
            </i>
            <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
            <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
        </div>
        <a href="{{ route('jobs.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>

    <div class="small-box bg-success">
        <div class="inner">
            <h3>未読{{ $unreadDmCount }}件</h3>

            <p>DM</p>
        </div>
        <div class="icon">
            <i class="ion">
                <ion-icon name="mail-unread-outline"></ion-icon>
            </i>
            <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
            <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
        </div>
        <a href="{{ route('unreadDm') }}" class="small-box-footer">More info<i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
@else

<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-info">
        <div class="inner">
            <h3>未読{{ $unreadAnnouncementCount }}件</h3>

            <p>管理者からのお知らせ</p>
        </div>
        <div class="icon">
            <i class="far fa-bell"></i>
        </div>
        <a href="{{ route('announcements.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        <span class="badge badge-warning navbar-badge">{{ $announcements->count() }}</span>
    </div>

    <div class="small-box bg-success">
        <div class="inner">
            <h3>未読{{ $unreadDmCount }}件</h3>

            <p>DM</p>
        </div>
        <div class="icon">
            <i class="ion">
                <ion-icon name="mail-unread-outline"></ion-icon>
            </i>
            <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
            <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
        </div>
        <a href="{{ route('unreadDm') }}" class="small-box-footer">More info<i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>


@endif
@endsection