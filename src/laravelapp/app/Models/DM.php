<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DM extends Model
{
    use HasFactory;

    protected $table = 'dm'; // テーブル名を 'dm' に設定

    protected $fillable = [
        'user_id',
        'job_id',
        'content',
        'dm_status',
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function unreadMessages()
    {
        return $this->hasMany(UnreadDm::class, 'dm_id');
    }
}
