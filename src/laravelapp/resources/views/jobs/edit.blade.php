@extends('layouts.common')

@section('content')

<!-- <div class="container">
    <div class="container">
        <h2>案件管理</h2>
        <form action="{{ route('jobs.update', ['id' => $job->id]) }}" method="post">
            @csrf
            @method('PUT')

            @if (Auth::user()->user_type === 1)
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
            @else
            <div class="form-group">
                <h4>案件名: {{ $job->job_name }}</h4>
                <h4>案件詳細: {{ $job->job_details }}</h4>
                <h4>予算: {{ $job->job_reward }}円</h4>
                <h4>交通費: {{ $job->job_travel_cost }}円</h4>
                <h4>経費: {{ $job->job_expense }}円</h4>
            </div>
            @endif

            @if (Auth::user()->user_type === 1)
            <h4>納品予定日: {{ $job->job_end_date }}</h4>
            @elseif (Auth::user()->user_type !== 1)
            <div class="form-group">
                <label for="job_end_date">納品予定日</label>
                <input type="date" class="form-control" id="job_end_date" name="job_end_date" value="{{ $job->job_end_date }}">
            </div>
            @endif

            <h4>案件status: {{ $job->job_status }}</h4>

            <button type="submit" class="btn btn-primary">更新</button>
        </form>

    </div>
    <hr>



    <h3>ファイル管理</h3>
    <table class="table">
        <thead>
            <tr>
                <th>ファイル名</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($job->jobFiles as $file)
            <tr>
                <td><a href="{{ asset($file->file_path) }}" target="_blank">{{ $file->file_name }}</a></td>
                <td>
                    <a href="{{ route('download.file', ['id' => $file->id]) }}" class="btn btn-sm btn-success">ダウンロード</a>
                    <a href="{{ route('delete.file', ['id' => $file->id]) }}" class="btn btn-sm btn-danger">削除</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>-->

<!-- <div class="text-center mt-5 mb-3">
    <a href="#" class="btn btn-sm btn-primary">Add files</a>
</div> -->

<!--<h3>案件削除</h3>
    <form id="deleteForm" action="{{ route('jobs.delete', ['id' => $job->id]) }}" method="post">
        @csrf
        @method('DELETE')
        <button type="button" class="btn btn-danger" onclick="confirmDelete()">案件を削除する</button>
    </form>

    <script>
        function uploadFile() {
            if (confirm('ファイルを再アップロードしますか？')) {
                document.getElementById('uploadForm').submit();
            }
        }

        function confirmDelete() {
            if (confirm('本当にこの案件を削除しますか？')) {
                document.getElementById('deleteForm').submit();
            }
        }
    </script>

</div> -->


<!-- Content Wrapper. Contains page content -->

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
    <div class="row">
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-body">
                    <form action="{{ route('jobs.update', ['id' => $job->id]) }}" method="post">
                        @csrf
                        @method('PUT')

                        @if (Auth::user()->user_type === 1)
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
                        @else
                        <div class="form-group">
                            <h4>案件名: {{ $job->job_name }}</h4>
                            <h4>案件詳細: {{ $job->job_details }}</h4>
                            <h4>予算: {{ $job->job_reward }}円</h4>
                            <h4>交通費: {{ $job->job_travel_cost }}円</h4>
                            <h4>経費: {{ $job->job_expense }}円</h4>
                        </div>
                        @endif

                        <!-- @if (Auth::user()->user_type === 1)
                        <h4>納品予定日: {{ $job->job_end_date }}</h4>
                        @elseif (Auth::user()->user_type !== 1)

                        <form action="{{ route('jobs.updateEndDate', ['id' => $job->id]) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="new_job_end_date">納品予定日</label>
                                <input type="date" class="form-control" id="new_job_end_date" name="job_end_date" value="">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">更新</button>
                            </div>
                        </form>
                        @endif

                        <h4>案件status: {{ $job->job_status }}</h4> -->

                        @if ($job->job_status === 3)
                        <div class="form-group">
                            <button type="submit" name="update_status" value="4" class="btn btn-primary">研修完了</button>
                        </div>
                        @endif


                        <!-- ユーザータイプが1以外の場合の表示 -->
                        <div class="form-group">
                            <label for="job_end_date">納品予定日</label>
                            <input type="date" class="form-control" id="job_end_date" name="job_end_date" value="{{ $job->job_end_date ? \Carbon\Carbon::parse($job->job_end_date)->format('Y-m-d') : '' }}">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">更新</button>
                        </div>


                        <h4>案件status: {{ $job->job_status }}</h4>
                        @if ($job->job_status === 3)
                        <div class="form-group">
                            <button type="submit" name="update_status" value="4" class="btn btn-primary">研修完了</button>
                        </div>
                        @endif
                    </form>
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
                                <td><a href="{{ asset($file->file_path) }}" target="_blank">{{ $file->file_name }}</a></td>
                                <td>
                                    <a href="{{ route('download.file', ['id' => $file->id]) }}" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                    @if (Auth::user()->user_type === 1)
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
                                <td><a href="{{ asset($file->file_path) }}" target="_blank">{{ $file->file_name }}</a></td>
                                <td>
                                    <a href="{{ route('download.file', ['id' => $file->id]) }}" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                    @if ($job->job_status !== 4)
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
            <form action="{{ route('upload.file_1', ['job_id' => $job->id]) }}" method="POST" enctype="multipart/form-data" multiple>
                @csrf
                <label for="fileInput" class="btn btn-success col fileinput-button">
                    <i class="fas fa-plus"></i>
                    <span>ファイルを選択</span>
                </label>
                <input id="fileInput" type="file" name="file" style="display: none;" multiple>
                <div id="selectedFileNames"></div>
                <button type="submit" class="btn btn-primary col start">
                    <i class="fas fa-upload"></i>
                    <span>ファイルアップロード</span>
                </button>
            </form>
            @else
            @if ($job->job_status !== 4)
            <form action="{{ route('upload.file_2', ['job_id' => $job->id]) }}" method="POST" enctype="multipart/form-data" multiple>
                @csrf
                <label for="fileInput" class="btn btn-success col fileinput-button">
                    <i class="fas fa-plus"></i>
                    <span>ファイルを選択</span>
                </label>
                <input id="fileInput" type="file" name="file" style="display: none;" multiple>
                <div id="selectedFileNames"></div>
                <button type="submit" class="btn btn-primary col start">
                    <i class="fas fa-upload"></i>
                    <span>ファイルを納品</span>
                </button>
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



</section>
<!-- /.content -->


@endsection