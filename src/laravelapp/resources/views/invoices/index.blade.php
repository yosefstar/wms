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
                                795 Folsom Ave, Suite 600<br>
                                San Francisco, CA 94107<br>
                                Phone: (804) 123-5432<br>
                                Email: info@almasaeedstudio.com
                            </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            To
                            <address>
                                <strong>{{ Auth::user()->user_name }}</strong><br>
                                {{ Auth::user()->street_address }}<br>
                                {{ Auth::user()->city }}, {{ Auth::user()->prefecture_id }} {{ Auth::user()->postal_code }}<br>
                                Phone: {{ Auth::user()->user_phone_number }}<br>
                                Email: {{ Auth::user()->email }}
                            </address>
                        </div>

                    </div>
                    <!-- /.row -->

                    <!-- Table row -->
                    <div class="row">
                        <div class="col-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>個数</th>
                                        <th>案件タイトル</th>
                                        <th>数量</th>
                                        <th>単価</th>
                                        <th>合計金額</th>
                                    </tr>
                                </thead>
                                @php
                                $totalAmount = 0; // 合計金額の初期化
                                @endphp

                                @foreach ($jobs as $job)
                                @if ($job->job_status == 4)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $job->job_name }}</td>
                                    <td>1</td>
                                    <td>{{ $job->job_reward }}</td>
                                    <td>{{ $job->job_reward + $job->job_travel_cost + $job->job_expense }}</td>
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
                                        <th style="width:50%">Subtotal:</th>
                                        <td>{{ $totalAmount }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tax (10%)</th>
                                        <td>{{ $totalAmount * 0.1 }}</td>
                                    </tr>
                                    <tr>
                                        <th>Total:</th>
                                        <td>{{ $totalAmount *1.1 }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- this row will not appear when printing -->
                    <div class="row no-print">
                        <div class="col-12">
                            <a href="{{ route('invoices.pdf') }}" class="btn btn-primary float-right" style="margin-right: 5px;">
                                <i class="fas fa-download"></i> Generate PDF
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.invoice -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</section>

@endsection