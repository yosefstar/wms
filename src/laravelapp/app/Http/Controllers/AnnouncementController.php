<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function index()
    {
        // ここにお知らせ一覧のデータ取得などの処理を追加
        // 例えば、$notifications = Notification::all();
        // return view('notifications.index', compact('notifications'));
        return view('announcements');
    }

    // 他のメソッドや処理を追加
}
