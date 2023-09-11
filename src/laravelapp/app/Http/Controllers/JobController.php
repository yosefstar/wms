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
    public function index(Request $request)
    {
        if (Auth::user()->user_type === 2) {
            $jobs = Job::where('job_contractor_id', Auth::id())->get();
        } else {
            $jobs = Job::all();
        }

        $user = Auth::user();

        $selectedStatus = $request->input('status', '');
        $writerOptions = $this->getWriterOptions();
        $selectedWriter = $request->input('writer', '');
        return view('jobs.index', compact('user', 'jobs', 'selectedStatus', 'writerOptions', 'selectedWriter',));
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

    public function updateJobEndDate(Request $request, $jobId)
    {
        // フォームから納品予定日を取得
        $jobEndDate = $request->input('job_end_date');

        // データベースの該当するジョブを特定
        $job = Job::find($jobId);

        // 納品予定日を設定し、job_statusを2に変更
        $job->job_end_date = $jobEndDate;
        $job->job_status = 2;
        $job->save();

        // 成功メッセージをセット
        session()->flash('success', 'ジョブステータスが更新されました.');

        return view('jobs.edit', compact('job'));
    }

    public function complete(Request $request, $jobId)
    {
        // フォームから送信されたupdate_statusの値を取得
        $updateStatus = $request->input('update_status');

        // データベースの該当するジョブを特定
        $job = Job::find($jobId);

        if ($job) {
            // job_statusをフォームからの値に変更
            $job->job_status = $updateStatus;

            // job_check_dateを現在の日付と時間に更新
            $job->job_check_date = now();  // Carbonのnow()関数を使用

            // 変更を保存
            $job->save();

            // 成功メッセージをセット
            session()->flash('success', 'ジョブステータスが更新されました。');
        } else {
            // ジョブが見つからない場合のエラーメッセージをセット
            session()->flash('error', 'ジョブが見つかりませんでした。');
        }

        // リダイレクトまたは適切なアクションを実行
        return redirect()->back();
    }


    private function mapStatusToValue($statusOption)
    {
        switch ($statusOption) {
            case '対応中':
                return 2;
            case '納品済':
                return 3;
            case '検収済':
                return 4;
            default:
                return null; // 不明なオプションの場合は null などを返す
        }
    }

    public function search(Request $request)
    {
        // フォームから案件名を取得
        $jobName = $request->input('job_name');
        $selectedWriter = $request->input('writer'); // 選択されたライター名
        $selectedStatus = $request->input('status', 'すべて');
        // データベースクエリを構築
        $jobsQuery = Job::query();

        if (!empty($jobName)) {
            $jobsQuery->where('job_name', 'like', '%' . $jobName . '%');
        }

        if (!empty($selectedWriter)) {
            // 選択されたライター名に基づいて絞り込みを追加
            $jobsQuery->where('job_client_id', $selectedWriter);
        }

        if (!empty($selectedStatus)) {
            // 選択されたステータスに基づいて絞り込みを追加
            $jobsQuery->where('job_status', $selectedStatus);
        }

        $jobs = $jobsQuery->get();
        $writerOptions = $this->getWriterOptions();
        $selectedWriter = $request->input('writer');
        return view('jobs.index', compact('jobs', 'writerOptions', 'selectedWriter', 'selectedStatus'));
    }

    private function getWriterOptions()
    {
        return User::where('user_type', 2)->pluck('user_name', 'id');
    }
}
