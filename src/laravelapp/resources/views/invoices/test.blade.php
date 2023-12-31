<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style type="text/css">
        @font-face {
            font-family: ipaexg;
            font-style: normal;
            font-weight: normal;
            src: url("{{ storage_path('fonts/ipaexg.ttf') }}") format('truetype');
        }

        @font-face {
            font-family: ipaexg;
            font-style: bold;
            font-weight: bold;
            src: url("{{ storage_path('fonts/ipaexg.ttf') }}") format('truetype');
        }

        .info-block {
            border: 1px solid #ccc;
            padding: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        body {
            font-family: ipaexg !important;
        }

        .hanko {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background-color: transparent;
            border: 1px solid red;
            position: relative;
        }

        .hanko-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 5px;
            color: red;
            font-weight: bold;
            writing-mode: vertical-rl;
            text-orientation: upright;
        }
    </style>


</head>

<body>
    <div style="width: 80%; margin: 0 auto;">
        <div style="text-align: right;">
            <p style="font-size: 0.6em; text-decoration: underline;">{{ now()->format('Y年m月d日') }}</p> <!-- 現在の日付を表示 -->
        </div>

        <div style="text-align: center;">
            <h1 style="border-bottom: 3px solid #000; margin: 0;">請 求 書</h1>
        </div>
        <div style="text-align: center; margin-top: 10px; font-size: 12px;">
            INVOICE
        </div>
        <div>
            <div style="display: flex; justify-content: space-between;">
                <!-- 右側 -->
                <div class="info-block" style="text-align: right;">
                    <p>2023年08月31日</p>
                    <p>{{ Auth::user()->user_name }}</p>
                    <p>{{ Auth::user()->postal_code }}</p>
                    <p>{{ Auth::user()->city }} {{ Auth::user()->street_address }} {{ Auth::user()->bilding_and_room }}</p>
                    <p>TEL : {{ Auth::user()->user_phone_number }}</p>
                    <p>{{ Auth::user()->email }}</p>
                    <div class="hanko">
                        <div class="hanko-text">{{ Auth::user()->user_name }}</div>
                    </div>
                </div>
                <!-- 左側 -->
                <div style="text-align: left; flex: 1;">
                    <div style="border-bottom: 1px solid #000; padding: 5px 0; font-size: 12px;">
                        株式会社Grander 御中
                    </div>
                    <div style="font-size: 12px; margin-top: 10px;">
                        下記のとおりご請求申し上げます。
                    </div>

                </div>

            </div>
        </div>


        <div>

        </div>

        @php
        $totalAmount = 0; // 合計金額の初期化
        @endphp

        <!-- <div style="text-align: right; font-size: 14px; margin-top: 10px;">
            ご請求金額 {{ number_format($totalAmount * 1.1) }} 円
        </div> -->
        <div style="border-bottom: 1px solid #000;"></div>
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr>
                    <th style="border: 1px solid #000; padding: 8px; text-align: center;">摘要</th>
                    <th style="border: 1px solid #000; padding: 8px; text-align: center;">数 量</th>
                    <th style="border: 1px solid #000; padding: 8px; text-align: center;">単 価</th>
                    <th style="border: 1px solid #000; padding: 8px; text-align: center;">金 額</th>
                </tr>
            </thead>
            <tbody>
                @php
                $totalAmount = 0; // 合計金額の初期化
                @endphp

                @foreach ($jobs as $job)
                @if ($job->job_status == 4)
                <tr>
                    <td style="border: 1px solid #000; padding: 8px;">{{ $job->job_name }}</td>
                    <td style="border: 1px solid #000; padding: 8px; text-align: center;">1</td>
                    <td style="border: 1px solid #000; padding: 8px; text-align: center;">{{ number_format($job->job_reward) }} 円</td>
                    <td style="border: 1px solid #000; padding: 8px; text-align: center;">
                        {{ number_format($job->job_reward + $job->job_travel_cost + $job->job_expense) }} 円
                    </td>
                </tr>

                @php
                $totalAmount += $job->job_reward + $job->job_travel_cost + $job->job_expense; // 金額を加算
                @endphp
                @endif
                @endforeach
            </tbody>
        </table>
        <table>

            <tr>
                <td>小計:</td>
                <td>{{ $totalAmount }} 円</td>
            </tr>
            <tr>
                <td style="color: red;">源泉所得税:</td>
                <td>{{ $totalAmount * 0.121 }} 円</td>
            </tr>
            <tr>
                <td>消費税:</td>
                <td>{{ $totalAmount * 0.1 }} 円</td>
            </tr>
            <tr>
                <td>合計金額:</td>
                <td>{{ $totalAmount + $totalAmount * 0.1 + $totalAmount * 0.1 }} 円</td>
            </tr>

        </table>
        <table style="width: 100%; border-collapse: collapse; border: 1px solid black;">
            <tr>
                <td>お振込先</td>
            </tr>
            <tr>
                <td>{{ Auth::user()->bank_name }} {{ Auth::user()->branch_name }} {{ Auth::user()->bank_account_type }} {{ Auth::user()->bank_account_number }} {{ Auth::user()->bank_account_holder_name }}</td>
            </tr>
        </table>
        <table style="width: 100%; border-collapse: collapse; border: 1px solid black;">
            <tr>
                <td style="width: 50%;">
                    @php
                    // 現在の日付を取得
                    $issueDate = \Carbon\Carbon::now();

                    // 発行日の月末日を計算
                    $dueDate = $issueDate->endOfMonth();
                    @endphp

                    <p>お支払い期限: {{ $dueDate->format('Y年m月d日') }}</p>
                </td>
                <td style="width: 50%;">
                    <!-- ここにもう一つのコンテンツを追加できます -->
                </td>
            </tr>
        </table>
    </div>

    <ul>
        <li>振込先</li>
        <li>名義：カ）カキクケショウジ</li>
        <li>〇〇銀行 〇〇支店 普通 00000000</li>
    </ul>
    <p>※お振込み手数料は御社ご負担にてお願い致します。</p>

    </section>
</body>

</html>