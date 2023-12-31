@extends('layouts.common')

@section('content')
<div class="container">
    <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="wrapper">
            <!-- <div class="content-wrapper"> -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>新規ユーザー作成</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">新規ユーザー作成</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <section class="content">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-primary">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="user_name">氏名:</label>
                                    <input type="text" class="form-control" id="user_name" name="user_name" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">パスワード:</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                                <div class="form-group">
                                    <label for="user_nickname">ユーザーニックネーム:</label>
                                    <input type="text" class="form-control" id="user_nickname" name="user_nickname" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">ユーザーメール:</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="form-group">
                                    <label for="user_icon">ユーザーアイコン</label>
                                    <input type="file" class="form-control-file" id="user_icon" name="user_icon">
                                </div>
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="user_type_checkbox" onchange="updateUserType()">
                                    <label class="form-check-label" for="user_type_checkbox">ユーザータイプ (チェックで1、未チェックで2)</label>
                                    <input type="hidden" id="user_type" name="user_type" value="2">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-secondary">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="postal_code">郵便番号</label>
                                    <input type="text" class="form-control" id="postal_code" name="postal_code">
                                </div>
                                <div class="form-group">
                                    <label for="prefecture_id">都道府県ID</label>
                                    <input type="number" class="form-control" id="prefecture_id" name="prefecture_id">
                                </div>
                                <div class="form-group">
                                    <label for="city">市区町村</label>
                                    <input type="text" class="form-control" id="city" name="city">
                                </div>
                                <div class="form-group">
                                    <label for="street_address">町名・番地</label>
                                    <input type="text" class="form-control" id="street_address" name="street_address">
                                </div>
                                <div class="form-group">
                                    <label for="building_and_room">建物名・部屋番号</label>
                                    <input type="text" class="form-control" id="building_and_room" name="building_and_room">
                                </div>
                                <div class="form-group">
                                    <label for="user_phone_number">ユーザー電話番号</label>
                                    <input type="text" class="form-control" id="user_phone_number" name="user_phone_number">
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="bank_name">銀行名</label>
                                    <input type="text" class="form-control" id="bank_name" name="bank_name">
                                </div>
                                <div class="form-group">
                                    <label for="branch_name">支店名</label>
                                    <input type="text" class="form-control" id="branch_name" name="branch_name">
                                </div>
                                <div class="form-group">
                                    <label for="bank_account_type">口座種別</label>
                                    <input type="text" class="form-control" id="bank_account_type" name="bank_account_type">
                                </div>
                                <div class="form-group">
                                    <label for="bank_account_number">口座番号</label>
                                    <input type="text" class="form-control" id="bank_account_number" name="bank_account_number">
                                </div>
                                <div class="form-group">
                                    <label for="bank_account_holder_name">口座名義</label>
                                    <input type="text" class="form-control" id="bank_account_holder_name" name="bank_account_holder_name">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">

                    </div>
                </div>
            </section>
        </div>

    </form>

    <script>
        function updateUserType() {
            document.getElementById('user_type').value = document.getElementById('user_type_checkbox').checked ? '1' : '2';
        }
    </script>
</div>
@endsection