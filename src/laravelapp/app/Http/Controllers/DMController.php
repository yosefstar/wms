<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DM;
use App\Models\Job;
use App\Models\User;
use App\Models\Comment;
use App\Models\UnreadDm;

class DMController extends Controller
{
    public function index($jobId)
    {
        // $jobId に対応する job_id を持つ DM メッセージを取得
        $dms = DM::where('job_id', $jobId)
            ->orderBy('created_at', 'desc')
            ->get();

        $comments = [];
        if ($dms->isNotEmpty()) {
            $dmId = $dms[0]->id; // 最新のDMメッセージのIDを取得
            $comments = Comment::where('dm_id', $dmId)->get();

            // 特定の未読DMエントリを削除
            $user = auth()->user(); // 現在のユーザーを取得
            UnreadDm::where('dm_id', $dmId)
                ->where('user_id', $user->id)
                ->delete();
        }


        $dm = DM::where('job_id', $jobId)->first();
        $dmId = $dm ? $dm->id : null; // dmテーブルのidを取得
        // $comments = $dm ? $dm->content : null; // dmテーブルのcontentを取得
        $comments = Comment::where('dm_id', $dmId)->get();

        // $jobId に対応する案件情報を取得
        $job = Job::find($jobId);

        return view('dm.index', [
            'job' => $job,
            'jobId' => $jobId,
            'dms' => $dms,
            'comments' => $comments,
            'dmId' => $dmId, // $dmId を設定
        ]);
    }

    public function usersIndex($userId, $jobClientId = null)
    {
        // $userId に対応する receiver_id を持つ DM メッセージを取得
        $dms = DM::where('receiver_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        // 最新のDMメッセージのIDを取得
        $dmId = $dms->isNotEmpty() ? $dms[0]->id : null;

        $comments = [];
        if ($dms->isNotEmpty()) {
            $dmId = $dms[0]->id; // 最新のDMメッセージのIDを取得
            $comments = Comment::where('dm_id', $dmId)->get();

            // 特定の未読DMエントリを削除
            $user = auth()->user(); // 現在のユーザーを取得
            UnreadDm::where('dm_id', $dmId)
                ->where('user_id', $user->id)
                ->delete();
        }

        return view('dm.usersIndex', [
            'dms' => $dms,
            'comments' => $comments,
            'userId' => $userId,
            'jobClientId' => $jobClientId, // jobClientId をビューに渡す
        ]);
    }





    public function create()
    {
        return view('dm.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'content' => 'required|string',
            'job_id' => 'required|integer',
        ]);

        $dm = new DM();
        $dm->content = $validatedData['content'];
        $dm->user_id = Auth::id();
        $dm->job_id = $validatedData['job_id'];

        // Job テーブルから job_client_id を取得
        $jobClientId = Job::where('id', $dm->job_id)->value('job_client_id');

        // job_client_id の値を receiver_id に設定
        $dm->receiver_id = $jobClientId ?? 0; // ジョブが見つからない場合のデフォルト値
        // ユーザーのuser_typeに応じてdm_statusを設定
        $userId = Auth::id();
        $user = User::find($userId);
        if ($user) {
            if ($user->user_type == 1) {
                $dm->dm_status = 1;
            } elseif ($user->user_type == 2) {
                $dm->dm_status = 2;
            }
        }


        $dm->save();

        // 未読エントリを作成
        $users = User::all();
        foreach ($users as $user) {
            UnreadDm::create([
                'user_id' => $user->id,
                'dm_id' => $dm->id,
            ]);
        }

        return redirect()->route('dm.index', ['jobId' => $request->input('job_id')])
            ->with('success', 'ダイレクトメッセージが送信されました');
    }


    public function usersStore(Request $request, $userId)
    {
        // バリデーションルールを定義する（必要に応じて変更してください）
        $rules = [
            'content' => 'required|string', // contentフィールドは必須で文字列である必要があります
        ];

        // バリデーションを実行
        $validatedData = $request->validate($rules);

        // DMを保存
        $dm = new DM();
        $dm->user_id = auth()->user()->id; // 送信ユーザーのIDを取得する方法に応じて変更してください
        $dm->job_id = 0; // job_idを0に設定
        $dm->content = $validatedData['content'];
        // ユーザーのuser_typeに応じてdm_statusを設定
        $user = User::find($userId);
        if ($user) {
            if ($user->user_type == 1) {
                $dm->dm_status = 1;
            } elseif ($user->user_type == 2) {
                $dm->dm_status = 2;
            }
        }
        $dm->receiver_id = $userId; // 受信者のユーザーIDを設定
        $dm->save();

        // unread_dm テーブルに未読エントリを作成
        $users = User::all();
        foreach ($users as $user) {
            // 送信者のユーザーIDと受信者のユーザーIDが異なる場合のみ未読エントリを作成
            if ($user->id !== auth()->user()->id) {
                UnreadDm::create([
                    'user_id' => $user->id,
                    'dm_id' => $dm->id, // 作成したDMのIDを使用
                ]);
            }
        }

        $jobClientId = $userId;
        return redirect()->route('dm.usersIndex', ['userId' => $userId, 'jobClientId' => $jobClientId])
            ->with('success', 'DMが送信されました。');
    }


    public function unreadDm()
    {
        // 認証済みのユーザーのIDを取得
        $userId = auth()->user()->id;

        // 未読のDMメッセージを取得
        $dmMessages = DM::select('id', 'receiver_id', 'job_id', 'content')
            ->where('receiver_id', $userId)
            ->get();

        // 認証済みのユーザーのIDを取得
        $userId = auth()->user()->id;


        // ユーザー名を取得
        $userNames = User::whereIn('id', $dmMessages->pluck('receiver_id')->toArray())
            ->pluck('user_name', 'id');

        // jobデータを取得
        $jobs = Job::whereIn('id', $dmMessages->pluck('job_id')->toArray())->get();

        $dmAdminMessages = DM::where('dm_status', 1)->get();

        // ユーザー名を取得
        $userNames2 = User::whereIn('id', $dmAdminMessages->pluck('receiver_id')->toArray())
            ->pluck('user_name', 'id');

        // jobデータを取得
        $jobs2 = Job::whereIn('id', $dmAdminMessages->pluck('job_id')->toArray())->get();

        $users = User::all();
        return view('unreadDm', compact('dmMessages', 'dmAdminMessages', 'userNames', 'userNames2', 'jobs', 'jobs2', 'users',));
    }
}
