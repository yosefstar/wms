<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;
use App\Models\Job;

class DashboardController extends Controller
{
    public function index()
    {
        $notifications = Announcement::all(); // お知らせ一覧を取得
        $notificationCount = $notifications->count(); // お知らせの件数を取得

        $jobCount = Job::count(); // jobsテーブルの全案件数を取得
        $ongoingJobCount = Job::where('job_status', '<>', 4)->count(); // job_statusが4でない案件の数を取得

        return view('dashboard', compact('notificationCount', 'jobCount', 'ongoingJobCount'));
    }
}
