@extends('layouts.app')

@section('content')
<div class="container">
    <h2>案件管理</h2>
    <a href="{{ route('jobs.create') }}" class="btn btn-primary mb-3">案件登録</a>
    <table class="table">
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
            <tr>
                <td>1</td>
                <td>タイトル</td>
                <td>氏名(ニックネーム)(一意ではだめ）</td>
                <td>検修済み</td>
                <td>報酬 交通費 経費 納品予定日</td>
                <td>詳細・編集・削除 dm</td>
            </tr>
            <!-- 他の案件情報をここに追加 -->
        </tbody>
    </table>
</div>
@endsection