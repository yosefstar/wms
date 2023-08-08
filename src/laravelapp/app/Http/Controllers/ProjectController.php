<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        // ここに案件一覧のデータ取得などの処理を追加
        // 例えば、$projects = Project::all();
        // return view('projects.index', compact('projects'));
        return view('projects');
    }

    // 他のメソッドや処理を追加
}
