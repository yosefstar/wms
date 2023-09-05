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
        $validatedData = $request->validate([
            'content' => 'required|string',
        ]);


        $comment = new Comment();
        $comment->content = $validatedData['content'];
        $comment->user_id = Auth::id();
        $comment->dm_id = $dmId;


        return redirect()->back()->with('success', 'コメントが送信されました');
    }

    public function show($dmId)
    {
        // $dmId を使用して必要なデータを取得

        return view('comments.show', [
            'dmId' => $dmId,
            // その他のデータをここで取得
        ]);
    }
}
