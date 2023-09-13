@extends('layouts.common')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>DM一覧</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">DM一覧</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            @foreach ($dmMessages as $dmMessage)

            <div class="col-md-12"> <!-- col-md-12で囲む -->
                <div class="card card-outline card-info">
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <h3 class="card-title">
                                ライター: {{ $userNames[$dmMessage->receiver_id] }}
                            </h3>
                        </div>
                        <div class="card-body">
                            @if ($dmMessage->job_id === 0)
                            <p>案件外</p>
                            @else
                            @php
                            $job = $jobs->firstWhere('id', $dmMessage->job_id);
                            @endphp
                            @if ($job)
                            <p>{{ $job->job_name }}</p>
                            @endif
                            @endif
                            <p>メッセージ：{{ $dmMessage->content }}</p>
                            @if ($dmMessage->job_id === 0)
                            @php
                            $user = auth()->user();
                            @endphp
                            <a href="{{ route('dm.usersIndex', ['jobId' => $dmMessage->job_id, 'receiver_id' => $dmMessage->receiver_id]) }}">dmを確認</a>
                            @else
                            <a href="{{ route('dm.index', ['jobId' => $job->id]) }}">案件dmを確認</a>
                            @endif

                            @php
                            // $dmMessage->hasNewMessages を取得
                            $hasNewMessages = $dmMessage->hasNewMessages;
                            @endphp
                            <!-- 未読のメッセージがあるかを確認し、あれば新着メッセージを表示 -->
                            @if ($hasNewMessages)
                            <p>新着メッセージあり</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach



            @foreach ($dmAdminMessages as $dmMessage)
            @if (auth()->user()->user_type === 1)
            <div class="col-md-12"> <!-- col-md-12で囲む -->
                <div class="card card-outline card-info">
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <h3 class="card-title">
                                <p>ライター: {{ $userNames2[$dmMessage->receiver_id] ?? '不明なユーザー' }}</p>
                            </h3>
                        </div>
                        <div class="card-body">

                            @if ($dmMessage->job_id === 0)
                            <p>案件外</p>
                            @else
                            @php
                            $job = $jobs2->firstWhere('id', $dmMessage->job_id);
                            @endphp
                            @if ($job)
                            <p>{{ $job->job_name }}</p>
                            @endif
                            @endif
                            <p>メッセージ：{{ $dmMessage->content }}</p>
                            @if ($dmMessage->job_id === 0)
                            <a href="{{ route('dm.usersIndex', ['receiver_id' => $dmMessage->receiver_id]) }}">dmを確認</a>
                            @else
                            <a href="{{ route('dm.index', ['jobId' => $job->id]) }}">案件dmを確認</a>
                            @endif

                            @php
                            // $dmMessage->hasNewMessages を取得
                            $hasNewMessages = $dmMessage->hasNewMessages;
                            @endphp
                            <!-- 未読のメッセージがあるかを確認し、あれば新着メッセージを表示 -->
                            @if ($hasNewMessages)
                            <p>新着メッセージあり</p>
                            @endif

                        </div>

                    </div>
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>
</section>



@endsection