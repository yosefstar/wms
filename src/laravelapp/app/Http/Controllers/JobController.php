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
        if (Auth::user()->user_type === 2) {
            $jobs = Job::where('job_contractor_id', Auth::id())->get();
        } else {
            $jobs = Job::all();
        }

        return view('jobs.index', compact('jobs'));
    }

    protected function getContractorNickname($contractorId)
    {
        $contractor = User::find($contractorId);
        return $contractor ? $contractor->user_nickname : 'Unknown Contractor';
    }

    public function create()
    {
        $users = User::all();
        return view('jobs.create', compact('users'));
    }

    public function edit($id)
    {
        $job = Job::findOrFail($id);
        return view('jobs.edit', compact('job'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'job_name' => 'required|string|max:255',
            'job_details' => 'nullable|string',
            'job_reward' => 'nullable|numeric',
            'job_travel_cost' => 'nullable|numeric',
            'job_expense' => 'nullable|numeric',
            'job_contractor_id' => 'required|exists:users,id',
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

        // アップロードされたファイルの処理
        $attachmentIds = [];
        if ($request->hasFile('job_attachments')) {
            foreach ($request->file('job_attachments') as $file) {
                $fileName = $file->getClientOriginalName();
                $filePath = $file->store('public/files'); // 保存先のディレクトリを適切に指定してください

                $attachment = JobFile::create([
                    'job_id' => $job->id,
                    'user_id' => auth()->user()->id,
                    'file_name' => $fileName,
                    'file_path' => $filePath,
                    'file_status' => 1,
                ]);

                $attachmentIds[] = $attachment->id;
            }
        }

        // フォームデータにアップロードされたファイルの ID を設定
        $job->attachment_ids = $attachmentIds;

        return redirect()->route('jobs.index')->with('success', '案件が登録されました。');
    }

    public function update(Request $request, $id)
    {
        $job = Job::findOrFail($id);

        if ($request->has('update_status') && $request->input('update_status') == 4) {
            $job->job_status = 4;
            $job->save();

            return redirect()->route('jobs.index')->with('success', '案件が更新されました。');
        }

        if (Auth::user()->user_type === 1) {
            $job->job_name = $request->input('job_name');
            $job->job_details = $request->input('job_details');
            $job->job_reward = $request->input('job_reward');
            $job->job_travel_cost = $request->input('job_travel_cost');
            $job->job_expense = $request->input('job_expense');
            // ... 他のフィールドの更新処理 ...
            $job->save();

            return redirect()->route('jobs.index')->with('success', '案件が更新されました。');
        }
    }

    // 他のアクションは省略

    public function show($id)
    {
        if (Auth::user()->user_type === 1) {
            $job = Job::findOrFail($id);
        } else {
            $job = Job::where('job_contractor_id', Auth::id())->findOrFail($id);
        }

        return view('jobs.show', compact('job'));
    }

    public function updateJobStatus(Request $request, Job $job)
    {
        $newJobStatus = $request->input('new_job_status');

        $job->update(['job_status' => 4]);

        return view('jobs.show', compact('job'));
    }

    public function updateEndDate(Request $request, $id)
    {
        $job = Job::findOrFail($id);

        // リクエストから送信された新しい日付を取得して job_end_date を更新
        $newEndDate = $request->input('job_end_date');
        $job->job_end_date = $newEndDate;
        $job->save();

        return view('jobs.show', compact('job'));
    }
}
