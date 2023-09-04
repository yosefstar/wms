<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use Illuminate\Support\Facades\Auth;

// use Barryvdh\DomPDF\ServiceProvider as PDF;
use PDF;

class InvoicesController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $jobs = Job::where('job_contractor_id', $user->id)->get(); // ログインユーザーに関連するジョブを取得

        return view('invoices.index', compact('user', 'jobs'));
    }

    public function createPdf()
    {
        $pdf = PDF::loadView('invoices.pdf');
        return $pdf->download('納品書.pdf'); //こちらがダウンロード用機能
    }
}
