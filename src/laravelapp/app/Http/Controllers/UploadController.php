<?php

// UserIcon.php

// UploadController.php

namespace App\Http\Controllers;

use App\Models\UserIcon;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function showForm()
    {
        return view('upload');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'user_icon' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('user_icon')) {
            $file = $request->file('user_icon');
            $url = UserIcon::store($file);
            return "ファイルがアップロードされました。URL: " . $url;
        }

        return "ファイルが選択されていません。";
    }
}
