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
                    <form method="POST" action="{{ route('jobs.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="job_contractor_id">案件実施者:</label>
                            <select class="form-control" id="job_contractor_id" name="job_contractor_id">
                                @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->user_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="job_name">案件タイトル:</label>
                            <input type="text" class="form-control" id="job_name" name="job_name" required>
                        </div>
                        <div class="form-group">
                            <label for="job_details">案件詳細:</label>
                            <textarea class="form-control" id="job_details" name="job_details"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="job_reward">予算:</label>
                            <input type="number" class="form-control" id="job_reward" name="job_reward">
                        </div>
                        <div class="form-group">
                            <label for="job_travel_cost">交通費:</label>
                            <input type="number" class="form-control" id="job_travel_cost" name="job_travel_cost">
                        </div>
                        <div class="form-group">
                            <label for="job_expense">経費:</label>
                            <input type="number" class="form-control" id="job_expense" name="job_expense">
                        </div>

                        <div class="form-group">
                            <label for="job_attachments">案件に添付する資料:</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="exampleInputFile" name="job_attachments[]" multiple>
                                    <label class="custom-file-label" for="exampleInputFile">ファイルを選択</label>
                                </div>
                            </div>
                        </div>

                        <script>
                            const fileInput = document.getElementById('exampleInputFile');
                            const customFileLabel = document.querySelector('.custom-file-label');

                            fileInput.addEventListener('change', () => {
                                if (fileInput.files.length > 0) {
                                    let fileNames = '';
                                    for (const file of fileInput.files) {
                                        fileNames += file.name + ', ';
                                    }
                                    customFileLabel.textContent = fileNames.slice(0, -2); // Remove trailing comma and space
                                } else {
                                    customFileLabel.textContent = 'Choose file';
                                }
                            });
                        </script>

                        <button type="submit" class="btn btn-primary">登録</button>
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <button onclick="goBack()" class="btn btn-primary">戻る</button>


            <script>
                function goBack() {
                    window.history.back();
                }
            </script>
        </div>
</section>

@endsection