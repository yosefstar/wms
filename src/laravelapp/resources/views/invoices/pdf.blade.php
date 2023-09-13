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



        /* 汎用クラス */
        .text-left {
            text-align: left;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .clear-element {
            clear: both;
        }

        /* 大枠の指定 */

        div.row_1 {
            height: 14mm;
        }

        div.row_2 {
            height: 12mm;
        }

        div.row_3 {
            height: 55mm;
            display: flex;
            justify-content: flex-start;
            /* 子要素を左寄せにする */
        }

        .col_1 {
            /* 追加のスタイリングが必要な場合 */
        }

        .col_2 {
            margin-left: auto;
            /* 残りの空間を左側に持ってくる */
        }

        div.row_3 div.col_1 {
            width: 90mm;
            float: left;
        }

        div.row_3 div.col_2 {
            position: relative;
            z-index: 2;
            padding-top: 10mm;
            float: left;
        }

        div.row_4 {
            height: 18mm;
        }

        div.row_5 {
            height: 120mm;
        }

        div.row_6 {
            height: 18mm;
        }

        /* 個別のスタイル指定 */


        /* タイトル */
        h1 {
            background: #3366cc;
            font-size: 30px;
            font-weight: normal;
            letter-spacing: 30px;
            color: #ffffff;
        }

        /* 顧客名・自社名 */
        h2 {
            font-size: 20px;
            font-weight: normal;
        }

        /* 顧客名 */
        h2.customer_name {
            text-decoration: underline;
        }

        img.stamp {
            position: absolute;
            z-index: 1;
            top: 10mm;
            left: 48mm;
            height: 17mm;
            width: 17mm;
        }

        /* テーブル共通 */
        table,
        th,
        td {
            border: 1px #264d99 solid;
            border-collapse: collapse;
            padding: 1px 5px;
        }

        table th {
            background: #3366cc;
            font-weight: normal;
            color: #ffffff;
        }

        table td {
            text-align: right;
        }

        /* テーブル 総額欄 */
        table.summary th {
            font-size: 14pt;
            width: 32mm;
        }

        table.summary td {
            font-size: 14pt;
            width: 40mm;
        }

        /* テーブル 明細欄 */
        table.detail {
            width: 100%;
        }

        table.detail tr {
            height: 6mm;
        }

        table.detail th.item {
            width: 50%;
        }

        table.detail th.unit_price {
            width: 18%;
        }

        table.detail th.amount {
            width: 14%;
        }

        table.detail th.subtotal {
            width: 18%;
        }

        table.detail td.space {
            border-left-style: hidden;
            border-bottom-style: hidden;
        }

        table.detail tr.dataline:nth-child(odd) td {
            background-color: #ccddff;
        }

        table.detail tr.dataline:nth-child(even) td {
            background-color: #ffffff;
        }

        .stamp {
            font-size: 10px;
            border: 3px double #f00;
            border-radius: 50%;
            color: #f00;
            width: 64px;
            height: 64px;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .stamp span {
            text-align: center;
            line-height: 1;
        }



        .stamp span:last-child {
            position: absolute;
            top: 38px;
            left: 0;
            right: 0;
            margin: auto;
            width: 80%;
            line-height: 0.1;
        }
    </style>


</head>

<body>

    <section class="sheet">
        <div class="row_1">
            <h1 class="text-center">御請求書</h1>
        </div>
        <div class="row_2">
            <p class="text-right">{{ now()->format('Y年m月d日') }}</p>
        </div>
        <div class="row_3">
            <div class="col_1">
                <h2 class="customer_name">株式会社Grander 御中</h2>
                <p>〒160-0023</p>
                <p>東京都新宿区西新宿6丁目11-3 Dタワー西新宿16階</p>
            </div>
            <div class="col_2">
                <h2>{{ Auth::user()->user_name }}</h2>
                <p>{{ Auth::user()->postal_code }}</p>
                <p>{{ Auth::user()->city }} {{ Auth::user()->street_address }}</p>
                <p>{{ Auth::user()->building_and_room }}</p>
                <p>TEL : {{ Auth::user()->user_phone_number }}</p>
                <p>{{ Auth::user()->email }}</p>
            </div>
            <div class="col_2">
                <div class="stamp stamp-settle">
                    <span>{{ Auth::user()->user_name }}</span>
                </div>
            </div>
        </div>

        <div class="row_4">
            <table>
                <tbody>
                    <tr>
                        <th>合計金額</th>
                        <td>{{ $calculatedValue }} 円</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="row_5">
            <table class="detail">
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
                        <td style="border: 1px solid #000; padding: 8px;">【記事投稿】{{ $job->job_name }} 研修日:【{{ $job->job_check_date ? \Carbon\Carbon::parse($job->job_check_date)->format('Y年m月d日') : '' }}】</td>
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
                <tr>
                    <td class="space" rowspan="3" colspan="2"> </td>
                    <th> 小計 </th>
                    <td> {{ $totalAmount }} 円 </td>
                </tr>
                <tr>
                    <th>源泉所得税</th>
                    <td><span style="color: red;">-{{ ceil($totalAmount * 0.1021) }} 円</span></td>
                </tr>
                <tr>
                    <th>消費税 (10%)</th>
                    <td>{{ ceil($totalAmount * 0.1) }} 円</td>
                </tr>
                <tr>
                    <th>Total:</th>
                    <td>{{ ceil($totalAmount * 1.1 - $totalAmount * 0.1021) }} 円</td>
                </tr>
            </table>
        </div>

        <p>振込先</p>
        <p>名義：{{ Auth::user()->bank_account_holder_name }}</p>
        <p>{{ Auth::user()->bank_name }}銀行 {{ Auth::user()->branch_name }}支店 {{ Auth::user()->bank_account_type }} {{ Auth::user()->bank_account_number }}</p>


        @php
        // 現在の日付を取得
        $issueDate = \Carbon\Carbon::now();

        // 来月の月末日を計算
        $dueDate = $issueDate->addMonth()->endOfMonth();
        @endphp

        <p>お支払い期限: {{ $dueDate->format('Y年m月d日') }}</p>
    </section>
</body>

</html>