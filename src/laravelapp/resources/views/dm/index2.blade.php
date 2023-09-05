@extends('layouts.common')

@section('content')
<!-- Content Header (Page header) -->
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
    <form method="POST" action="{{ route('dm.store') }}">
        @csrf
        <div class="form-group">
            <label for="content">DM内容:</label>
            <textarea name="content" id="content" class="form-control" required></textarea>
        </div>
        <input type="hidden" name="job_id" value="{{ $jobId }}">
        <button type="submit" class="btn btn-primary">送信</button>
    </form>
    <h2>送信されたDM一覧</h2>
    @if ($dms->isEmpty())
    <p>まだDMがありません。</p>
    @else
    <ul>
        @foreach($dms as $dm)
        <li>{{ $dm->content }}</li>
        @endforeach
    </ul>
    @endif
</div>

<!-- 以下に右側のコンテンツを追加 -->
<div class="wrapper">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <!-- /.row -->
                <!-- Main row -->
                <div class="row">
                    <!-- Left col -->
                    <section class="col-lg-7 connectedSortable">
                        <!-- DIRECT CHAT -->
                        <div class="card direct-chat direct-chat-primary">
                            <div class="card-header">
                                <h3 class="card-title">Direct Chat</h3>
                                <div class="card-tools">
                                    <span title="3 New Messages" class="badge badge-primary">3</span>
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <!-- Conversations are loaded here -->
                                <div class="direct-chat-messages">
                                    <!-- Message. Default to the left -->
                                    <!-- ここにチャットメッセージのコードを追加 -->
                                </div>
                                <!--/.direct-chat-messages-->
                                <!-- /.direct-chat-pane -->
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <form action="#" method="post">
                                    <div class="input-group">
                                        <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                                        <span class="input-group-append">
                                            <button type="button" class="btn btn-primary">Send</button>
                                        </span>
                                    </div>
                                </form>
                                <form method="POST" action="{{ route('dm.store') }}">
                                    @csrf
                                    <div class="form-group">
                                        <textarea name="content" id="content" class="form-control" required></textarea>
                                    </div>
                                    <input type="hidden" name="job_id" value="{{ $jobId }}">
                                    <button type="submit" class="btn btn-primary">送信</button>
                                </form>
                            </div>
                            <!-- /.card-footer-->
                        </div>
                    </section>
                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <!-- /.control-sidebar -->
</div>
@endsection