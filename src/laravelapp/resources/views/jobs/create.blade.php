@extends('layouts.app')

@section('content')
<div class="container">
    <h2>案件登録</h2>
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
            <input type="file" class="form-control-file" id="job_attachments" name="job_attachments[]" multiple>
        </div>

        <button type="submit" class="btn btn-primary">登録</button>
    </form>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <button class="btn btn-secondary">担当者にDMする</button>
</div>
@endsection