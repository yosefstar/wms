@extends('layouts.common')

@section('content')

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
                    <li class="breadcrumb-item active">Projects</li>
                </ol>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-sm-12">
                <a href="{{ route('jobs.create') }}" class="btn btn-primary float-right">新しい案件を作成</a>
            </div>
        </div>
        <form action="{{ route('search') }}" method="GET">
            <div class="form-group">
                <label for="status">ステータス</label>
                <select name="status" id="status" class="form-control">
                    <option value="">すべて</option>
                    <option value="1" @if ($selectedStatus==='1' ) selected @endif>未対応</option>
                    <option value="2" @if ($selectedStatus==='2' ) selected @endif>対応中</option>
                    <option value="3" @if ($selectedStatus==='3' ) selected @endif>納品済</option>
                    <option value="4" @if ($selectedStatus==='4' ) selected @endif>検収済</option>
                </select>
            </div>
            @if ($user->user_type == 1)
            <div class="form-group">
                <label for="writer">ライター名</label>
                <select name="writer" id="writer" class="form-control" onchange="this.form.submit()">
                    <option value="">すべて</option>
                    @foreach ($writerOptions as $userId => $userName)
                    <option value="{{ $userId }}" @if ($selectedWriter==$userId) selected @endif>{{ $userName }}</option>
                    @endforeach
                </select>
            </div>
            @endif
            <div class="form-group">
                <label for="jobName">案件名</label>
                <input type="text" class="form-control" id="job_name" name="job_name" placeholder="案件名を入力">
            </div>
            <button type="submit" class="btn btn-primary">検索</button>
        </form>

    </div><!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card">
        <div class="card-body p-0">
            <table class="table table-striped projects">
                <thead>
                    <tr>
                        <th>案件ID</th>
                        <th>案件名</th>
                        <th>ライター名</th>
                        <th>案件ステータス</th>
                        @if ($user->user_type == 1)
                        <th>詳細・編集・停止</th>
                        @elseif ($user->user_type == 2)
                        <th>詳細・編集</th>
                        @endif
                        <th>dm</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jobs as $job)
                    <tr>
                        <td>{{ $job->id }}</td>
                        <td>{{ $job->job_name }}</td>
                        <td>{{ $job->contractorNickname() }}</td>
                        <td>
                            @if ($job->job_status === 1)
                            未対応
                            @elseif ($job->job_status === 2)
                            対応中
                            @elseif ($job->job_status === 3)
                            納品済
                            @elseif ($job->job_status === 4)
                            検収済
                            @else
                            未定義
                            @endif
                        </td>
                        <td>
                            @if ($user->user_type == 1)
                            <a href="{{ route('jobs.edit', ['id' => $job->id]) }}">詳細・編集・停止</a>
                            @elseif ($user->user_type == 2)
                            <a href="{{ route('jobs.edit', ['id' => $job->id]) }}">詳細・編集</a>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('dm.index', ['jobId' => $job->id]) }}">dm</a>
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
<!-- </div> -->
<!-- /.content -->

<!-- /.content-wrapper -->
@endsection