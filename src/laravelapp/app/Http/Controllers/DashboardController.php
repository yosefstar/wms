<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;
use App\Models\Job;

class DashboardController extends Controller
{
    public function index()
    {
        // お知らせデータをデータベースから取得
        $announcements = Announcement::published()->get();
        $expiredAnnouncements = Announcement::expired()->get();

        $jobCount = Job::count(); // jobsテーブルの全案件数を取得
        $ongoingJobCount = Job::where('job_status', '<>', 4)->count(); // job_statusが4でない案件の数を取得

        return view('dashboard', compact('announcements', 'expiredAnnouncements', 'jobCount', 'ongoingJobCount'));
    }
}
