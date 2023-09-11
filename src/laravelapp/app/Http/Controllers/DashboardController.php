<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;
use App\Models\Job;
use App\Models\UnreadAnnouncement;
use App\Models\UnreadDM;

class DashboardController extends Controller
{
    public function index()
    {
        // お知らせデータをデータベースから取得
        $announcements = Announcement::published()->get();
        $expiredAnnouncements = Announcement::expired()->get();

        $jobCount = Job::count(); // jobsテーブルの全案件数を取得
        $ongoingJobCount = Job::where('job_status', '<>', 4)->count(); // job_statusが4でない案件の数を取得

        $unreadAnnouncementCount = UnreadAnnouncement::countUnreadAnnouncementsForUser(auth()->user()->id);
        $unreadDmCount = UnreadDm::where('user_id', auth()->id())->count();

        return view('dashboard', compact('announcements', 'expiredAnnouncements', 'jobCount', 'ongoingJobCount', 'unreadAnnouncementCount', 'unreadDmCount'));
    }
}
