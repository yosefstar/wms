@extends('layouts.common')

@section('content')
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
    <div class="row">
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-body">
                    @if (Auth::user()->user_type === 1)
                    @if ($job->job_status === 1)
                    <form action="{{ route('jobs.update', ['id' => $job->id]) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="job_name">案件名</label>
                            <input type="text" class="form-control" id="job_name" name="job_name" value="{{ $job->job_name }}">
                        </div>

                        <div class="form-group">
                            <label for="job_details">案件詳細</label>
                            <textarea class="form-control" id="job_details" name="job_details">{{ $job->job_details }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="job_reward">予算</label>
                            <input type="number" class="form-control" id="job_reward" name="job_reward" value="{{ $job->job_reward }}">
                        </div>

                        <div class="form-group">
                            <label for="job_travel_cost">交通費</label>
                            <input type="number" class="form-control" id="job_travel_cost" name="job_travel_cost" value="{{ $job->job_travel_cost }}">
                        </div>

                        <div class="form-group">
                            <label for="job_expense">経費</label>
                            <input type="number" class="form-control" id="job_expense" name="job_expense" value="{{ $job->job_expense }}">
                        </div>
                        <h4>案件ステータス:
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
                        </h4>
                    </form>

                    @elseif($job->job_status === 2)
                    <h4>案件名: {{ $job->job_name }}</h4>
                    <h4>案件詳細: {{ $job->job_details }}</h4>
                    <h4>予算: {{ $job->job_reward }}円</h4>
                    <h4>交通費: {{ $job->job_travel_cost }}円</h4>
                    <h4>経費: {{ $job->job_expense }}円</h4>
                    <h4>案件ステータス:
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
                    </h4>

                    @elseif($job->job_status === 3)
                    <h4>案件名: {{ $job->job_name }}</h4>
                    <h4>案件詳細: {{ $job->job_details }}</h4>
                    <h4>予算: {{ $job->job_reward }}円</h4>
                    <h4>交通費: {{ $job->job_travel_cost }}円</h4>
                    <h4>経費: {{ $job->job_expense }}円</h4>
                    <h4>案件ステータス:
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
                    </h4>
                    <form action="{{ route('jobs.complete', ['jobId' => $job->id]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary" name="update_status" value="4">研修完了</button>
                    </form>
                    @elseif($job->job_status === 4)
                    <h4>案件名: {{ $job->job_name }}</h4>
                    <h4>案件詳細: {{ $job->job_details }}</h4>
                    <h4>予算: {{ $job->job_reward }}円</h4>
                    <h4>交通費: {{ $job->job_travel_cost }}円</h4>
                    <h4>経費: {{ $job->job_expense }}円</h4>
                    <h4>案件ステータス:
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
                    </h4>
                    <form action="{{ route('jobs.complete', ['jobId' => $job->id]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary" name="update_status" value="3">研修に戻す</button>
                    </form>
                    @endif
                    @endif


                    <div class="form-group">
                        @if (Auth::user()->user_type !== 1)
                        @if ($job->job_status === 1)
                        <form action="{{ route('jobs.updateJobEndDate', ['id' => $job->id]) }}" method="post">
                            @csrf
                            @method('PUT')
                            <h4>案件名: {{ $job->job_name }}</h4>
                            <h4>案件詳細: {{ $job->job_details }}</h4>
                            <h4>予算: {{ $job->job_reward }}円</h4>
                            <h4>交通費: {{ $job->job_travel_cost }}円</h4>
                            <h4>経費: {{ $job->job_expense }}円</h4>
                            <div class="form-group">
                                <label for="job_end_date">納品予定日</label>
                                <input type="date" class="form-control" id="job_end_date" name="job_end_date" value="{{ $job->job_end_date ? \Carbon\Carbon::parse($job->job_end_date)->format('Y-m-d') : '' }}">
                            </div>
                            <h4>案件ステータス:
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
                            </h4>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">更新だ</button>
                            </div>
                        </form>

                        @else
                        <h4>案件名: {{ $job->job_name }}</h4>
                        <h4>案件詳細: {{ $job->job_details }}</h4>
                        <h4>予算: {{ $job->job_reward }}円</h4>
                        <h4>交通費: {{ $job->job_travel_cost }}円</h4>
                        <h4>経費: {{ $job->job_expense }}円</h4>
                        <h4>案件終了日: {{ $job->job_end_date }}</h4>
                        <h4>案件ステータス:
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
                        </h4>
                        @endif
                        @endif
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <div class="col-md-6">
            <!-- /.card -->
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">参考資料ファイル</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ファイル名</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($job->jobFiles as $file)
                            @if ($file->file_status === 1)
                            <tr>
                                <td>{{ $file->file_name }}</td>
                                <td>
                                    <a href="{{ route('download.file', ['id' => $file->id]) }}" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                    @if ($job->job_status === 1)
                                    @if (Auth::user()->user_type === 1)
                                    <a href="{{ route('delete.file', ['id' => $file->id]) }}" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                    @endif
                                    @endif
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">納品ファイル</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ファイル名</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($job->jobFiles as $file)
                            @if ($file->file_status === 2)
                            <tr>
                                <td>{{ $file->file_name }}</td>
                                <td>
                                    <a href="{{ route('download.file', ['id' => $file->id]) }}" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                    @if ($job->job_status === 1 || $job->job_status === 2)
                                    <a href="{{ route('delete.file', ['id' => $file->id]) }}" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                    @endif
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>


            @if(Auth::user()->user_type == 1)
            @if ($job->job_status == 2)
            <form action="{{ route('upload.file_1', ['job_id' => $job->id]) }}" method="POST" enctype="multipart/form-data" multiple>
                @csrf
                <label for="fileInput" class="btn btn-success col fileinput-button">
                    <i class="fas fa-plus"></i>
                    <span>ファイルを追加</span>
                </label>
                <input id="fileInput" type="file" name="file" style="display: none;" multiple>
                <div id="selectedFileNames"></div>
                <button type="submit" class="btn btn-primary col start">
                    <i class="fas fa-upload"></i>
                    <span>ファイルアップロード</span>
                </button>
            </form>
            @endif
            @endif

            @if(Auth::user()->user_type == 2)
            @if ($job->job_status == 2)
            <form action="{{ route('upload.file_2', ['job_id' => $job->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <label for="fileInput" class="btn btn-success col fileinput-button">
                    <i class="fas fa-plus"></i>
                    <span>納品ファイルを選択</span>
                </label>
                <input id="fileInput" type="file" name="file[]" style="display: none;" multiple>
                <div id="selectedFileNames"></div>

                <button type="submit" class="btn btn-primary col start">
                    <i class="fas fa-upload"></i>
                    <span>ファイルを納品</span>
                </button>
            </form>

            <form action="{{ route('jobs.complete', ['jobId' => $job->id]) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary float-right mt-2" name="update_status" value="3" style="background-color: blue; padding: 10px;">研修依頼</button>
            </form>
            @endif
            @endif
        </div>
    </div>

    <script>
        const fileInput = document.getElementById('fileInput');
        const selectedFileNames = document.getElementById('selectedFileNames');

        fileInput.addEventListener('change', () => {
            if (fileInput.files.length > 0) {
                selectedFileNames.innerHTML = `<p>選択したファイル:</p>`;
                for (const file of fileInput.files) {
                    selectedFileNames.innerHTML += `<p>${file.name}</p>`;
                }
            } else {
                selectedFileNames.innerHTML = '';
            }
        });
    </script>

    @if(Auth::user()->user_type == 1)
    @if ($job->job_status !== 4)
    <td>
        <form action="{{ route('jobs.destroy', $job->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">削除</button>
        </form>
    </td>
    @endif
    @endif

    <button onclick="goBack()" class="btn btn-primary">戻る</button>


    <script>
        function goBack() {
            window.history.back();
        }
    </script>


</section>
<!-- /.content -->


@endsection