<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\DM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $dmId)
    {
        // ログインユーザーのIDを取得して設定
        $userId = Auth::id();

        $comment = new Comment();
        $comment->content = $request->input('content'); // contentをセット
        $comment->user_id = $userId;
        $comment->dm_id = $dmId;
        $comment->save();

        return redirect()->back()->with('success', 'コメントが送信されました');
    }


    public function show($dm_id)
    {
        // 現在のDMページIDと一致するコメントを取得
        $comments = Comment::where('dm_id', $dm_id)->get();

        return view('dm.index', ['comments' => $comments, 'currentDmPageId' => $dm_id]);
    }
}
