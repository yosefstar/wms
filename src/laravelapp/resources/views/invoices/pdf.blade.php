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

        body {
            font-family: ipaexg !important;
        }
    </style>
</head>

<body>
    <p style="text-align:right;">2023年8月31日</p>
    <h1 style="border-bottom:2px solid #000; text-align:center;">請求書</h1>
    <p style="text-align:center;">invoice</p>
    <div style="display:flex; margin-top:20px;">
        <div style="width:70%;">
            <p style="border-bottom:1px solid #000; text-align:center;">株式会社Grander 御中</p>
            <p style="text-align:center;">下記のとおりご請求申し上げます。</p>
            <p style="border-bottom:1px solid #000; text-align:center;">ご請求金額 35000円</p>
        </div>
        <div style="width:30%;">
            <p style="border-bottom:1px solid #000; text-align:center;">請求書</p>
            <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">

        </div>
    </div>

</body>

</html>