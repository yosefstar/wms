<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DM;
use App\Models\Job;

class DMController extends Controller
{
    public function index($jobId)
    {
        $job = Job::find($jobId);
        $dms = DM::orderBy('created_at', 'desc')->get();
        $dmExists = DM::where('job_id', $jobId)
            ->where('user_id', Auth::id())
            ->exists();

        return view('dm.index', [
            'job' => $job, 'jobId' => $jobId, 'dms' => $dms, 'dmExists' => $dmExists, 'dmId' => null, 'comments' => null
        ]);
    }

    public function create()
    {
        return view('dm.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'content' => 'required|string',
            'job_id' => 'required|integer', // job_id フィールドのバリデーション
        ]);

        $dm = new DM();
        $dm->content = $validatedData['content'];
        $dm->user_id = Auth::id(); // ログインしているユーザーのIDを取得して設定
        $dm->job_id = $validatedData['job_id']; // フォームから提供された job_id を設定
        $dm->save();

        return redirect()->back()->with('success', 'DMが送信されました');
    }
}
