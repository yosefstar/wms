<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Invoice;
use App\Models\User;
use App\Models\InvoiceUser;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

// use Barryvdh\DomPDF\ServiceProvider as PDF;
use PDF;

class InvoicesController extends Controller
{
    public function index(Request $request)
    {
        $user_id = $request->input('user_id');
        if ($user_id) {
            // 'user_id' パラメータが渡された場合、そのユーザー情報を取得
            $user = User::find($user_id);

            // ユーザー情報を使用して何か処理を行うことができます
            // 例: $user->name, $user->email, など
        } else {
            // 'user_id' パラメータが渡されなかった場合は、通常の認証ユーザー情報を取得
            $user = Auth::user();
        }


        $date = Carbon::now();

        // リクエストから`month`の値を取得し、存在しない場合は現在の月を設定する
        $currentMonth = $request->input('month', $date->format('Y年m月'));



        $invoices = Invoice::all();


        $prefectureId = $user->prefecture_id;
        $prefectures = [
            1 => '北海道',
            2 => '青森県',
            3 => '岩手県',
            4 => '宮城県',
            5 => '秋田県',
            6 => '山形県',
            7 => '福島県',
            8 => '茨城県',
            9 => '栃木県',
            10 => '群馬県',
            11 => '埼玉県',
            12 => '千葉県',
            13 => '東京都',
            14 => '神奈川県',
            15 => '新潟県',
            16 => '富山県',
            17 => '石川県',
            18 => '福井県',
            19 => '山梨県',
            20 => '長野県',
            21 => '岐阜県',
            22 => '静岡県',
            23 => '愛知県',
            24 => '三重県',
            25 => '滋賀県',
            26 => '京都府',
            27 => '大阪府',
            28 => '兵庫県',
            29 => '奈良県',
            30 => '和歌山県',
            31 => '鳥取県',
            32 => '島根県',
            33 => '岡山県',
            34 => '広島県',
            35 => '山口県',
            36 => '徳島県',
            37 => '香川県',
            38 => '愛媛県',
            39 => '高知県',
            40 => '福岡県',
            41 => '佐賀県',
            42 => '長崎県',
            43 => '熊本県',
            44 => '大分県',
            45 => '宮崎県',
            46 => '鹿児島県',
            47 => '沖縄県'
        ];

        if (array_key_exists($prefectureId, $prefectures)) {
            $prefectureName = $prefectures[$prefectureId];
        } else {
            $prefectureName = "都道府県が見つかりませんでした";
        }

        if ($request->has('submit')) {
            $invoiceId = $request->input('submit');
            $invoice = Invoice::find($invoiceId);

            if ($invoice) {
                $invoice->submit_status = 1; // 請求する場合、submit_statusを1に設定
                $invoice->save();
            }
        } elseif ($request->has('resubmit')) {
            $invoiceId = $request->input('resubmit');
            $invoice = Invoice::find($invoiceId);

            if ($invoice) {
                $invoice->submit_status = 1; // 再請求の場合もsubmit_statusを1に設定
                $invoice->save();
            }
        }

        $user_id = $request->input('user_id');
        $userId = $user_id ? $user_id : Auth::user()->id; // 'user_id' パラメータがあればそれを使い、なければ認証ユーザーのIDを使用

        $date = Carbon::now();


        // 条件に一致する請求書を取得
        $invoice = Invoice::where('billing_month', $currentMonth)
            ->where('user_id', $userId)
            ->first();



        $file_path = null; // デフォルト値を設定

        if ($invoice) {
            $file_path = $invoice->file_path;
        }

        $billingMonth = null;

        if (!$billingMonth) {
            // Carbon インスタンスに変換
            // クエリパラメーターから月と他のフィルタを取得
            $billingMonth = $request->input('billing_month', $date->format('Y年m月'));
            $billingMonthCarbon = Carbon::createFromFormat('Y年n月', $billingMonth);

            // 前月を計算
            $prevMonth = $billingMonthCarbon->copy()->subMonth()->format('Y年n月');
            $nextMonth = $billingMonthCarbon->copy()->addMonth()->format('Y年n月');
        }

        // prevMonthパラメーターが指定されている場合、1ヶ月前の月を計算
        if ($request->has('prevMonth')) {
            // Carbon インスタンスに変換
            $billingMonthCarbon = Carbon::createFromFormat('Y年n月', $billingMonth);
            $nextMonth = \Carbon\Carbon::createFromFormat('Y年n月', $billingMonth)->format('Y年n月');
            $billingMonth = \Carbon\Carbon::createFromFormat('Y年n月', $billingMonth)->subMonth()->format('Y年n月');
            // 前月を計算
            $prevMonth = \Carbon\Carbon::createFromFormat('Y年n月', $billingMonth)->subMonth()->format('Y年n月');
        }

        if ($request->has('nextMonth')) {
            // Carbon インスタンスに変換
            $billingMonthCarbon = Carbon::createFromFormat('Y年n月', $billingMonth);
            $prevMonth = \Carbon\Carbon::createFromFormat('Y年n月', $billingMonth)->format('Y年n月');
            $billingMonth = \Carbon\Carbon::createFromFormat('Y年n月', $billingMonth)->addMonth()->format('Y年n月');
            // 前月を計算
            $nextMonth = \Carbon\Carbon::createFromFormat('Y年n月', $billingMonth)->addMonth()->format('Y年n月');
        }



        $selectedStatus = $request->input('status', '');
        $selectedWriter = $request->input('writer', '');

        $date = Carbon::createFromFormat('Y年n月', $billingMonth)->startOfMonth();




        $query = Job::where('job_contractor_id', $user->id);

        $query->whereBetween('job_check_date', [$date, $date->copy()->endOfMonth()]);



        // ステータスとライターでフィルタリング
        if (!empty($selectedStatus)) {
            $query->where('job_status', $selectedStatus);
        }
        if (!empty($selectedWriter)) {
            $query->where('writer_id', $selectedWriter);
        }

        $jobs = $query->get();
        // // 前月の月を計算
        // $prevMonth = $billingMonth->copy()->subMonth();

        // // 次月の月を計算
        // $nextMonth = $billingMonth->copy()->addMonth();



        // フォーマットして dd() で表示

        return view('invoices.index', [
            'user' => $user,
            'jobs' => $jobs,
            'prefectureName' => $prefectureName,
            'selectedStatus' => $selectedStatus,
            'selectedWriter' => $selectedWriter,
            'currentMonth' => $currentMonth,
            'prevMonth' =>  $prevMonth,
            'nextMonth' =>  $nextMonth,
            'invoices' => $invoices,
            'file_path' => $file_path, // invoices の file_path を渡す
            'billingMonth' => $billingMonth,
        ]);
    }

    public function adminIndex()
    {
        $date = new \DateTime(); // 現在の日付を取得

        // 'currentMonth' ではなく、'selectedMonth' に現在の年月を格納
        $selectedMonth = $date->format('Y-m');

        $admininvoices = Invoice::where('submit_status', 1)
            ->join('users', 'invoices.user_id', '=', 'users.id')
            ->select('users.user_name', 'invoices.billing_month', 'invoices.user_id')
            ->orderBy('invoices.created_at', 'desc') // 新着順に並べ替え
            ->paginate(20); // ページネーションを適用
        $user = Auth::user();

        // ログイン中のユーザーの user_id を取得
        $userId = $user->id;

        // ログイン中のユーザーと同じ user_id を持つ invoices レコードを取得
        $usersinvoices = Invoice::where('user_id', $userId)
            ->where('submit_status', 1)
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('adminIndex', compact('user', 'admininvoices', 'selectedMonth', 'usersinvoices'));
    }


    public function createPdf(Request $request)  // 引数に $request を追加
    {
        $billingMonth = $request->input('billing_month');
        $user = Auth::user();

        $selectedStatus = $request->input('status', '');
        $selectedWriter = $request->input('writer', '');

        // $date = Carbon::createFromFormat('Y-m-d H:i:s', $billingMonth)->startOfMonth();
        $date = Carbon::createFromFormat('Y年m月', $billingMonth)->startOfMonth();


        $query = Job::where('job_contractor_id', $user->id);

        $query->whereBetween('job_check_date', [$date, $date->copy()->endOfMonth()]);

        if (!empty($selectedStatus)) {
            $query->where('job_status', $selectedStatus);
        }
        if (!empty($selectedWriter)) {
            $query->where('writer_id', $selectedWriter);
        }

        $jobs = $query->get();
        $totalAmount = 0;

        foreach ($jobs as $job) {
            if ($job->job_status == 4) {
                $totalAmount += $job->job_reward + $job->job_travel_cost + $job->job_expense;
            }
        }

        $calculatedValue = ceil($totalAmount * 1.1 - $totalAmount * 0.1021);
        $pdf = PDF::loadView('invoices.pdf', [
            'jobs' => $jobs,
            'calculatedValue' => $calculatedValue,
            'billingMonth' => $billingMonth  // ここに追加
        ]);

        return $pdf->download('納品書.pdf');
    }

    public function showTestInvoice()
    {
        $jobs = Job::all();
        return view('invoices.test', compact('jobs'));
    }

    public function createPdfAndSaveInvoice(Request $request)
    {
        $billingMonth = $request->input('billing_month');
        $user = Auth::user();

        $selectedStatus = $request->input('status', '');
        $selectedWriter = $request->input('writer', '');

        $date = Carbon::createFromFormat('Y年n月', $billingMonth)->startOfMonth();



        $query = Job::where('job_contractor_id', $user->id);

        $query->whereBetween('job_check_date', [$date, $date->copy()->endOfMonth()]);

        if (!empty($selectedStatus)) {
            $query->where('job_status', $selectedStatus);
        }
        if (!empty($selectedWriter)) {
            $query->where('writer_id', $selectedWriter);
        }

        $jobs = $query->get();
        $totalAmount = 0;

        foreach ($jobs as $job) {
            if ($job->job_status == 4) {
                $totalAmount += $job->job_reward + $job->job_travel_cost + $job->job_expense;
            }
        }

        $calculatedValue = ceil($totalAmount * 1.1 - $totalAmount * 0.1021);
        $pdf = PDF::loadView('invoices.pdf', [
            'jobs' => $jobs,
            'calculatedValue' => $calculatedValue  // ここに追加
        ]);

        // ファイル名生成
        $file_name = 'invoice_' . time() . '.pdf'; // 一意のファイル名
        $file_path = storage_path('app/public/invoices/' . $file_name); // 保存先

        // ファイルをローカルに保存
        $pdf->save($file_path);

        // データベースに保存
        $currentMonth = $request->input('billing_month', now()->format('Y年m月'));
        $user = Auth::user();

        // 請求書を作成し保存
        $invoice = Invoice::create([
            'user_id' => $user->id,
            'file_name' => $file_name,
            'file_path' => 'invoices/' . $file_name,
            'billing_month' => $currentMonth,
            'submit_status' => 1,
        ]);

        $invoiceUser = InvoiceUser::create([
            'user_id' => $user->id,
            'invoice_id' => $invoice->id,
            'billing_month' => $currentMonth,
        ]);

        return redirect()->back()->with('success', 'PDFを作成し、請求書も保存しました。');
    }

    public function updateInvoice(Request $request, $invoiceId)
    {
        $invoice = Invoice::find($invoiceId);

        if (!$invoice) {
            return redirect()->back()->with('error', '請求書が見つかりませんでした。');
        }

        // submit_statusを1に更新
        $invoice->update(['submit_status' => 1]);

        return redirect()->back()->with('success', '請求書を更新しました。');
    }
}
