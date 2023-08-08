<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;

class DashboardController extends Controller
{
    public function index()
    {
        $notifications = Announcement::all(); // お知らせ一覧を取得
        return view('dashboard');
    }
}
