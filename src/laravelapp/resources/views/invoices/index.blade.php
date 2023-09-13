@extends('layouts.common')

@section('content')


<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>請求書</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">請求書</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>


<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- Main content -->
                <div class="invoice p-3 mb-3">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-12">
                            <h4>
                                <i class="fas fa-globe"></i> Grander株式会社
                            </h4>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- info row -->
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                            From
                            <address>
                                <strong>Grander株式会社</strong><br>
                                〒160-0023<br>
                                東京都新宿区西新宿６丁目<br>
                                11-3 Dタワー西新宿16階<br>
                            </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            To
                            <address>
                                <strong>{{ $user->user_name }}</strong><br>
                                〒{{ $user->postal_code }}<br>
                                {{ $prefectureName }} {{ $user->city }} {{ $user->street_address }}<br>
                                {{ $user->building_and_room }}<br>
                                電話番号: {{ $user->user_phone_number }}<br>
                                Eメール: {{ $user->email }}
                            </address>
                        </div>

                    </div>
                    <!-- /.row -->

                    <!-- Table row -->
                    <div class="row">
                        <div class="col-12 mb-3 d-flex justify-content-between">
                            <!-- 先月へのリンク -->
                            <a href="{{ route('invoices.index', ['month' => $prevMonth]) }}" class="btn btn-secondary">先月</a>

                            <!-- 現在の月 -->
                            <span>請求月: {{ $currentMonth }}</span>

                            <!-- 来月へのリンク -->
                            <a href="{{ route('invoices.index', ['month' => $nextMonth]) }}" class="btn btn-secondary">来月</a>
                        </div>
                        <div class="col-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>個数</th>
                                        <th>案件タイトル</th>
                                        <th>数量</th>
                                        <th>単価</th>
                                        <th>合計金額</th>
                                        <th>詳細・編集・削除</th>
                                    </tr>
                                </thead>
                                @php
                                $totalAmount = 0; // 合計金額の初期化
                                @endphp

                                @foreach ($jobs as $job)
                                @if ($job->job_status == 4)
                                <tr>
                                    <td>1</td>
                                    <td>{{ $job->job_name }}</td>
                                    <td>1</td>
                                    <td>{{ $job->job_reward }} 円</td>
                                    <td>{{ $job->job_reward + $job->job_travel_cost + $job->job_expense }} 円</td>
                                    <td>

                                        <a href="{{ route('jobs.edit', ['id' => $job->id]) }}">詳細・編集・停止</a>
                                    </td>
                                </tr>

                                @php
                                $totalAmount += $job->job_reward + $job->job_travel_cost + $job->job_expense; // 金額を加算
                                @endphp
                                @endif
                                @endforeach
                                </tbody>

                            </table>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <div class="row">
                        <!-- accepted payments column -->
                        <div class="col-6">

                        </div>
                        <!-- /.col -->
                        <div class="col-6">


                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th style="width:50%">小計:</th>
                                        <td>{{ $totalAmount }} 円</td>
                                    </tr>
                                    <tr>
                                        <th>源泉所得税</th>
                                        <td><span style="color: red;">-{{ ceil($totalAmount * 0.1021) }} 円</span></td>
                                    </tr>
                                    <tr>
                                        <th>消費税 (10%)</th>
                                        <td>{{ $totalAmount * 0.1 }} 円</td>
                                    </tr>
                                    <tr>
                                        <th>Total:</th>
                                        <td>{{ ceil($totalAmount * 1.1 - $totalAmount * 0.1021) }} 円</td>

                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- this row will not appear when printing -->
                    <div class="row no-print">
                        <div class="col-12 d-flex justify-content-end align-items-center">
                            @if(Auth::check() && Auth::user()->user_type != 1)
                            <a href="{{ route('invoices.pdf') }}" class="btn btn-primary" style="margin-right: 5px;">
                                <i class="fas fa-download"></i> PDFを作成
                            </a>
                            @endif

                            @php
                            $invoiceFound = false; // 初期値をfalseに設定
                            @endphp

                            @foreach($invoices as $invoice)
                            @if($invoice->billing_month === $currentMonth && $invoice->user_id === Auth::user()->id)
                            @php
                            $invoiceFound = true; // 条件に合致する情報が存在する場合、trueに設定
                            @endphp
                            <!-- 既存の請求書がある場合 -->
                            @if($invoice->submit_status === 1)
                            <span>請求済み</span>
                            @else
                            @if(Auth::check() && Auth::user()->user_type != 1)
                            <form action="{{ route('updateInvoice', ['invoiceId' => $invoice->id]) }}" method="post">
                                @csrf
                                <button type="submit" name="resubmit" class="btn btn-primary">再請求する</button>
                            </form>
                            @endif
                            @endif
                            @endif
                            @endforeach

                            @if (!$invoiceFound)
                            @if(Auth::check() && Auth::user()->user_type != 1)
                            <form action="{{ route('createPdfAndSaveInvoice') }}" method="post">
                                @csrf
                                <input type="hidden" name="billing_month" value="{{ $currentMonth }}">
                                <button type="submit" name="submit" class="btn btn-primary">請求する</button>
                            </form>
                            @endif
                            @endif



                            @if(Auth::user()->user_type == 1)
                            <a href="{{ asset('storage/' . $file_path) }}" class="btn btn-primary" target="_blank">請求書を表示</a>
                            @endif


                        </div>
                    </div>
                </div>
                <!-- /.invoice -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</section>


@endsection