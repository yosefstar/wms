<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'dm_id',
        'content',
    ];

    // リレーションシップを定義する場合は、ここに追加

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function dm()
    {
        return $this->belongsTo(DM::class);
    }
}
