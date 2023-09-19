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
            <div class="card-header">
                <h3 class="card-title">Direct Chat</h3>
            </div>
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
        <button onclick="goBack()" class="btn btn-primary">戻る</button>


        <script>
            function goBack() {
                window.history.back();
            }
        </script>
    </div>
    <!-- ./wrapper -->


    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="plugins/moment/moment.min.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="dist/js/pages/dashboard.js"></script>

</div>
@endsection