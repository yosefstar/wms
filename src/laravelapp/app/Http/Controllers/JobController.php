<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobFile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::all();
        return view('jobs.index', compact('jobs'));
    }

    public function create()
    {
        $users = User::all(); // すべてのユーザーを取得
        return view('jobs.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'job_name' => 'required|string|max:255',
            'job_details' => 'nullable|string',
            'job_reward' => 'nullable|numeric',
            'job_travel_cost' => 'nullable|numeric',
            'job_expense' => 'nullable|numeric',
            'job_contractor_id' => 'required|exists:users,id', // ユーザーが存在するか確認
            'job_attachments' => 'nullable|array',
            'job_attachments.*' => 'nullable|file|mimes:pdf,docx',
        ]);

        $job = new Job();
        $job->job_name = $validatedData['job_name'];
        $job->job_details = $validatedData['job_details'];
        $job->job_reward = $validatedData['job_reward'];
        $job->job_travel_cost = $validatedData['job_travel_cost'];
        $job->job_expense = $validatedData['job_expense'];
        $job->job_contractor_id = $validatedData['job_contractor_id'];
        $job->job_client_id = Auth::id(); // ログインユーザーのIDを保存
        $job->save();

        // ファイルの処理と保存
        if ($request->hasFile('job_attachments')) {
            foreach ($request->file('job_attachments') as $attachment) {
                $filePath = $attachment->store('job_attachments');
                $jobFile = new JobFile();
                $jobFile->job_id = $job->id;
                $jobFile->file_path = $filePath;
                $jobFile->save();
            }
        }

        return redirect()->route('jobs.index')->with('success', '案件が登録されました。');
    }

    // 他のアクションを追加
}
