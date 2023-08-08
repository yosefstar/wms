@extends('layouts.app')

@section('content')
<div class="container">
    <h2>ファイルアップロード</h2>
    <form method="POST" action="{{ route('upload') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="user_icon">ユーザーアイコン:</label>
            <input type="file" class="form-control-file" id="user_icon" name="user_icon">
        </div>
        <button type="submit" class="btn btn-primary">アップロード</button>
    </form>

    @if($userIcon)
    <div class="mt-4">
        <h3>アップロードされた画像</h3>
        <img src="{{ $userIcon->url }}" alt="User Icon">
    </div>
    @endif
</div>
@endsection