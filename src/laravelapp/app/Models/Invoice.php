<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'invoices'; // テーブル名
    protected $primaryKey = 'id'; // プライマリーキーのカラム名

    // 可変項目（Mass Assignment）を設定
    protected $fillable = [
        'user_id',
        'file_name',
        'file_path',
        'submit_status',
    ];

    // 日付型へキャストする属性
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    // キャストする属性の定義
    protected $casts = [
        'submit_status' => 'integer', // 提出ステータスを整数としてキャスト
    ];
}
