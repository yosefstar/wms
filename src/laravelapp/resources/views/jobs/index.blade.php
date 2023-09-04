@extends('layouts.common')

@section('content')
<!-- <div class="container">
    <h2>案件管理</h2>
    @if (Auth::user()->user_type === 1)
    <a href="{{ route('jobs.create') }}" class="btn btn-primary mb-3">案件登録</a>
    @endif -->

<!-- <table class="table">
        <thead>
            <tr>
                <th>案件ID</th>
                <th>案件名</th>
                <th>ライター名</th>
                <th>案件status</th>
                <th>詳細・編集・削除</th>
                <th>dm</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jobs as $job)
            <tr>
                <td>{{ $job->id }}</td>
                <td>{{ $job->job_name }}</td>
                <td>{{ $job->contractorNickname() }}</td>
                <td>{{ $job->job_status }}</td>
                <td>

                    <a href="{{ route('jobs.edit', ['id' => $job->id]) }}" class="btn btn-warning">編集</a>

                </td>
                <td></td>
            </tr>
            @endforeach

        </tbody>
    </table> -->
<!-- </div> -->

<!-- <div class="content-wrapper"> -->
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>案件管理</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">案件管理</li>
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
                        <th>案件ID</th>
                        <th>案件名</th>
                        <th>ライター名</th>
                        <th>案件status</th>
                        <th>詳細・編集・削除</th>
                        <th>dm</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jobs as $job)
                    <tr>
                        <td>{{ $job->id }}</td>
                        <td>{{ $job->job_name }}</td>
                        <td>{{ $job->contractorNickname() }}</td>
                        <td>{{ $job->job_status }}</td>
                        <td>

                            <a href="{{ route('jobs.edit', ['id' => $job->id]) }}" class="btn btn-warning">編集</a>

                        </td>
                        <td><!-- DMリンクをここに表示 --></td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

</section>
<!-- </div> -->
<!-- /.content -->

<!-- /.content-wrapper -->
@endsection