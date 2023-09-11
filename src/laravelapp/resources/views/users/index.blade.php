@extends('layouts.common')

@section('content')

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

        <form method="GET" action="{{ route('users.index') }}">
            <div class="form-group">
                <label for="userType">ユーザータイプ</label>
                <select class="form-control" id="userType" name="userType">
                    <option value="">すべて</option>
                    <option value="1" {{ $selectedUserType == '1' ? 'selected' : '' }}>管理者</option>
                    <option value="2" {{ $selectedUserType == '2' ? 'selected' : '' }}>ライター</option>
                </select>
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
                        <th>ID</th>
                        <th>ユーザー名</th>
                        <th>アイコン</th>
                        <th>ニックネーム</th>
                        <th>作成日時</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($adminUsers as $adminUser)
                    @if ($selectedUserType == 1)
                    <tr>
                        <td>{{ $adminUser->id }}</td>
                        <td>{{ $adminUser->user_name }}</td>
                        <td>
                            @if ($adminUser->user_icon)
                            <img src="{{ $adminUser->user_icon }}" alt="アイコン" style="max-height: 50px; max-width: 50px;">
                            @else
                            No Image
                            @endif
                        </td>
                        <td>{{ $adminUser->user_nickname }}</td>
                        <td>{{ $adminUser->created_at }}</td>
                        <td>
                            <a href="{{ route('users.edit', $adminUser->id) }}">詳細・編集・停止</a>
                        </td>
                        <td>
                            <a href="{{ route('dm.usersIndex', $adminUser->id) }}">dm</a>
                        </td>
                    </tr>
                    @endif
                    @endforeach

                    @foreach ($writerUsers as $writerUser)
                    @if ($selectedUserType == 2)
                    <tr>
                        <td>{{ $writerUser->id }}</td>
                        <td>{{ $writerUser->user_name }}</td>
                        <td>
                            @if ($writerUser->user_icon)
                            <img src="{{ $writerUser->user_icon }}" alt="アイコン" style="max-height: 50px; max-width: 50px;">
                            @else
                            No Image
                            @endif
                        </td>
                        <td>{{ $writerUser->user_nickname }}</td>
                        <td>{{ $writerUser->created_at }}</td>
                        <td>
                            <a href="{{ route('users.edit', $writerUser->id) }}">詳細・編集・停止</a>
                        </td>
                        <td>
                            <a href="{{ route('dm.usersIndex', $writerUser->id) }}">dm</a>
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

</section>
<!-- /.content -->

<!-- /.content-wrapper -->


@endsection