@extends('layouts.common')

@section('content')
<!-- <div class="container">
    <h2>ユーザー一覧</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>ユーザー名</th>
                <th>アイコン</th>
                <th>ニックネーム</th>
                <th>作成日時</th>
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
</div> -->

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>ユーザー一覧</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Users</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card">
        <!-- <div class="card-header">
            <h3 class="card-title">ユーザー一覧</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div> -->
        <div class="card-body p-0">
            <table class="table table-striped projects">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>ユーザー名</th>
                        <th>アイコン</th>
                        <th>ニックネーム</th>
                        <th>作成日時</th>
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
                            <a href="{{ route('users.edit', $user->id) }}">詳細・編集・停止</a>
                        </td>
                        <td>
                            <a href="{{ route('dm.index', $user->id) }}">dm</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

</section>
<!-- /.content -->

<!-- /.content-wrapper -->


@endsection