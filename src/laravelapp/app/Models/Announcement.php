<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Announcement extends Model
{
    protected $table = 'announcements';

    protected $fillable = [
        'user_id', // ユーザーIDを追加
        'title',
        'content',
        'start_date',
        'end_date',
    ];

    // リレーションシップやその他のメソッドをここに追加することがあります

    public function scopePublished(Builder $query)
    {
        return $query->whereDate('start_date', '<=', now()); // 開始日が現在の日付よりも過去の記事を取得
    }

    public function scopeExpired(Builder $query)
    {
        return $query->whereDate('end_date', '>', now()); // 終了日が現在の日付よりも未来の記事を取得
    }
}
