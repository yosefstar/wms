<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;
use App\Models\User;
use App\Models\UnreadAnnouncement;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
{
    public function index()
    {
        // お知らせデータをデータベースから取得
        $announcements = Announcement::published()->get();
        $expiredAnnouncements = Announcement::expired()->get();
        $user = Auth::user();
        // ビューにデータを渡してお知らせ一覧を表示
        return view('announcements.index', compact('user', 'announcements', 'expiredAnnouncements'));
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

        // ログイン中のユーザーのIDを取得
        $userId = auth()->user()->id;

        // フォームからのデータで新しいお知らせを作成
        $newAnnouncement = Announcement::create([
            'user_id' => $userId, // ユーザーIDを設定
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
        ]);

        // 未読エントリを作成
        $users = User::all(); // すべてのユーザーを取得
        foreach ($users as $user) {
            UnreadAnnouncement::create([
                'user_id' => $user->id,
                'announcement_id' => $newAnnouncement->id,
            ]);
        }

        // ニュース一覧ページにリダイレクト
        return redirect()->route('announcements.index');
    }


    public function create()
    {
        // お知らせ作成ページの表示
        return view('announcements.create');
    }

    public function show($id)
    {
        // $id を使用して詳細情報をデータベースから取得
        $announcement = Announcement::find($id);

        // ログイン中のユーザーのIDを取得
        $userId = auth()->user()->id;

        // 未読お知らせエントリを取得
        $unreadAnnouncement = UnreadAnnouncement::where('user_id', $userId)
            ->where('announcement_id', $id)
            ->first();

        // 未読エントリが存在する場合は削除
        if ($unreadAnnouncement) {
            $unreadAnnouncement->delete();
        }

        // ビューにデータを渡して詳細ページを表示
        return view('announcements.show', compact('announcement'));
    }
}
