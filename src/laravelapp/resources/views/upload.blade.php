<!DOCTYPE html>
<html>

<head>
    <title>File Upload</title>
</head>

<body>
    <form action="{{ route('upload.file') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <select name="job_id">
            @foreach ($jobs as $job)
            <option value="{{ $job->id }}">{{ $job->title }}</option>
            @endforeach
        </select>
        <input type="file" name="file">
        <button type="submit">Upload</button>
    </form>
</body>

</html>