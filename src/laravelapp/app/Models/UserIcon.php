<?php

// app/Models/UserIcon.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class UserIcon extends Model
{
    // テーブル名を指定
    protected $table = 'user_icons';

    // ファイルを保存するメソッド
    public static function store($file)
    {
        $path = $file->store('public/user_icons');
        return Storage::url($path);
    }
}
