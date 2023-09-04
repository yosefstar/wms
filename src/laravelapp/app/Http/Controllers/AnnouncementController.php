<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;

class AnnouncementController extends Controller
{
    public function index()
    {
        // ここにお知らせ一覧のデータ取得などの処理を追加
        // 例えば、$notifications = Notification::all();
        // return view('notifications.index', compact('notifications'));
        return view('announcements');
    }

    public function store(Request $request)
    {
        // バリデーションルールを設定
        $rules = [
            'title' => 'required|max:255',
            'content' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date', // 終了日は開始日より後の日付である必要があります
        ];

        // バリデーションを実行
        $request->validate($rules);

        // フォームから送信されたデータを取得
        $data = $request->only(['title', 'content', 'start_date', 'end_date']);

        // ユーザーIDをログイン中のユーザーから取得
        $data['user_id'] = auth()->user()->id;

        // Announcementモデルを使用してデータベースに保存
        Announcement::create($data);

        // ニュース一覧ページにリダイレクト
        return redirect()->route('announcements.index');
    }


    // 他のメソッドや処理を追加
}
