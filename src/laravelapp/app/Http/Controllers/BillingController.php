<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BillingController extends Controller
{
    public function index()
    {
        // ここに請求情報のデータ取得などの処理を追加
        // 例えば、$billings = Billing::all();
        // return view('billing.index', compact('billings'));
        return view('billing');
    }

    // 他のメソッドや処理を追加
}
