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
    <div class="wrapper">


        <!-- DIRECT CHAT -->
        <div class="card direct-chat direct-chat-primary">
            @if (Auth::user()->user_type === 1)
            <div class="card-header">
                <h3 class="card-title">DM to {{ $receiverName }}</h3>
            </div>
            @endif

            @if (Auth::user()->user_type === 2)
            <div class="card-header">
                <h3 class="card-title">案件外</h3>
            </div>
            @endif
            <!-- /.card-header -->
            <div class="card-body">
                <!-- Conversations are loaded here -->
                <div class="direct-chat-messages">
                    @foreach ($dms as $dm)
                    @if ($dm->receiver_id == $receiver_id)
                    @if ($dm->job_id == 0)
                    <div class="direct-chat-msg @if ($dm->user_id === auth()->user()->id) right @endif">
                        <div class="direct-chat-infos clearfix">
                            <span class="direct-chat-name float-left">{{ $dm->created_at->format('d M H:i A') }}</span>
                            <span class="direct-chat-timestamp float-right">{{ $dm->user->user_name }}</span>
                        </div>
                        <img class="direct-chat-img" src="{{ $dm->user->user_icon }}" alt="message user image">
                        <div class="direct-chat-text">
                            <p>{{ $dm->content }}</p>
                        </div>
                    </div>
                    @endif
                    @endif
                    @endforeach
                </div>

            </div>
            <!-- /.card-body -->
            <div class="card-footer">

                <form method="POST" action="{{ route('dm.usersStore', ['receiver_id' => $receiver_id]) }}">
                    @csrf
                    <div class="form-group">
                        <textarea name="content" id="content" class="form-control" required></textarea>
                    </div>
                    <input type="hidden" name="job_id" value="0"> <!-- デフォルト値を0に設定 -->
                    <button type="submit" class="btn btn-primary">送信</button>
                </form>

            </div>
            <!-- /.card-footer-->
        </div>
        <!--/.direct-chat -->
        <a href="{{ route('unreadDm') }}" class="btn btn-primary">DM一覧へ</a>
        @if (Auth::user()->user_type === 1)
        <a href="{{ route('users.index') }}" class="btn btn-primary">ユーザー一覧へ</a>
        @endif
    </div>
    <!-- ./wrapper -->



    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>


</div>
@endsection