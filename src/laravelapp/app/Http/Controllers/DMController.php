<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DM;
use App\Models\Job;
use App\Models\User;
use App\Models\Comment;
use App\Models\UnreadDm;
use Illuminate\Support\Facades\DB;

class DMController extends Controller
{
    public function index($jobId)
    {
        // $jobId に対応する job_id を持つ DM メッセージを取得
        $dms = DM::where('job_id', $jobId)
            ->orderBy('created_at', 'desc')
            ->get();

        $dmIdsToDelete = DM::where('job_id', $jobId)
            ->pluck('id')
            ->toArray();

        // dm_idが取得できた場合のみ削除処理を行う
        if (!empty($dmIdsToDelete)) {
            // 現在のユーザーを取得
            $user = auth()->user();

            // 削除条件を指定して未読DMエントリを削除
            UnreadDm::where('user_id', $user->id)
                ->whereIn('dm_id', $dmIdsToDelete)
                ->delete();
        }


        $dm = DM::where('job_id', $jobId)->first();
        $dmId = $dm ? $dm->id : null; // dmテーブルのidを取得
        // $comments = $dm ? $dm->content : null; // dmテーブルのcontentを取得
        $comments = Comment::where('dm_id', $dmId)->get();

        // $jobId に対応する案件情報を取得
        $job = Job::find($jobId);

        $jobContractorId = Job::where('id', $jobId)->value('job_contractor_id');
        $jobContractor = User::find($jobContractorId);
        return view('dm.index', [
            'job' => $job,
            'jobId' => $jobId,
            'dms' => $dms,
            'dmId' => $dmId, // $dmId を設定
            'jobContractor' => $jobContractor,
        ]);
    }

    public function usersIndex($receiver_id)
    {
        // $userId に対応する receiver_id を持つ DM メッセージを取得
        $dms = DM::where('receiver_id', $receiver_id)
            ->orderBy('created_at', 'desc')
            ->get();


        // 最新のDMメッセージのIDを取得
        $dmId = $dms->isNotEmpty() ? $dms[0]->id : null;


        $dmIdsToDelete = DM::where('job_id', 0)
            ->where('receiver_id', $receiver_id)
            ->pluck('id')
            ->toArray();

        // dm_idが取得できた場合のみ削除処理を行う
        if (!empty($dmIdsToDelete)) {
            // 現在のユーザーを取得
            $user = auth()->user();

            // 削除条件を指定して未読DMエントリを削除
            UnreadDm::where('user_id', $user->id)
                ->whereIn('dm_id', $dmIdsToDelete)
                ->delete();
        }

        // リレーションを利用してユーザー情報を取得
        $user = User::where('id', $receiver_id)->first();

        return view('dm.usersIndex', [
            'dms' => $dms,
            'receiver_id' => $receiver_id,
            'user' => $user,
        ]);
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

        // Job テーブルから job_contractor_id を取得
        $job_contractor_id = Job::where('id', $dm->job_id)->value('job_contractor_id');

        // job_contractor_id の値を receiver_id に設定
        $dm->receiver_id = $job_contractor_id ?? 0; // ジョブが見つからない場合のデフォルト値
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

        $receiverId = $userId;
        return redirect()->route('dm.usersIndex',  ['receiver_id' => $receiverId])
            ->with('success', 'DMが送信されました。');
    }


    public function unreadDm()
    {
        // 認証済みのユーザーのIDを取得
        $userId = auth()->user()->id;

        $dmMessages = DB::table('dm')
            ->select('receiver_id', 'job_id', 'content', 'id as dm_id')
            ->whereIn('created_at', function ($query) use ($userId) {
                $query->select(DB::raw('MAX(created_at)'))
                    ->from('dm')
                    ->where('receiver_id', $userId)
                    ->groupBy('receiver_id', 'job_id');
            })
            ->get();


        foreach ($dmMessages as $dmMessage) {
            $dmMessage->hasNewMessages = DB::table('unread_dm')
                ->where('user_id', auth()->user()->id)
                ->where('dm_id', $dmMessage->dm_id)
                ->exists();
        }

        $uniqueReceiverIds = [];

        // 認証済みのユーザーのIDを取得
        $userId = auth()->user()->id;


        // ユーザー名を取得
        $userNames = User::whereIn('id', $dmMessages->pluck('receiver_id')->toArray())
            ->pluck('user_name', 'id');

        // jobデータを取得
        $jobs = Job::whereIn('id', $dmMessages->pluck('job_id')->toArray())->get();

        $dmAdminMessages = DB::table('dm')
            ->select('receiver_id', 'job_id', 'content', 'id as dm_id')
            ->whereIn('created_at', function ($query) use ($userId) {
                $query->select(DB::raw('MAX(created_at)'))
                    ->from('dm')
                    ->groupBy('receiver_id', 'job_id');
            })
            ->get();

        foreach ($dmAdminMessages as $dmMessage) {
            $dmMessage->hasNewMessages = DB::table('unread_dm')
                ->where('user_id', auth()->user()->id)
                ->where('dm_id', $dmMessage->dm_id)
                ->exists();
        }

        // ユーザーごとにメッセージをグループ化
        // ユーザー名を取得
        $userNames2 = User::whereIn('id', $dmAdminMessages->pluck('receiver_id')->toArray())
            ->pluck('user_name', 'id');

        // jobデータを取得
        $jobs2 = Job::whereIn('id', $dmAdminMessages->pluck('job_id')->toArray())->get();

        $users = User::all();
        $receiver_id = 3;
        return view('unreadDm', compact('uniqueReceiverIds', 'dmMessages', 'dmAdminMessages', 'userNames', 'userNames2', 'jobs', 'jobs2', 'users',));
    }
}
