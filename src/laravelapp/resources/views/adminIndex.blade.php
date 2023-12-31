@extends('layouts.common')

@section('content')

<div class="wrapper">
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
</div>

@if ($user->user_type == 1)
<section class="content">
    <div class="container-fluid">
        <div class="row">
            @foreach ($admininvoices as $invoice)
            <div class="col-md-12">
                <div class="card card-outline card-info">
                    <div class="card-header">
                        ライター名: {{ $invoice->user_name }}
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        請求月: {{ $invoice->billing_month }}
                        <a href="{{ route('invoices.index', ['month' => $currentMonth ?? $invoice->billing_month, 'user_id' => $invoice->user_id]) }}" class="btn btn-secondary">詳細</a>
                    </div>

                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- @if ($user->user_type == 2)
<section class="content">
    <div class="container-fluid">
        <div class="row">
            @foreach ($usersinvoices as $invoice)
            <div class="col-md-12">
                <div class="card card-outline card-info">
                    <div class="card-header">
                        ライター名: {{ $invoice->user_name }}
                    </div>

                    <div class="card-body">
                        請求月: {{ $invoice->billing_month }}
                        <a href="{{ route('invoices.index', ['month' => $currentMonth ?? $invoice->billing_month, 'user_id' => $invoice->user_id]) }}" class="btn btn-secondary">詳細</a>
                    </div>

                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif -->

@endsection