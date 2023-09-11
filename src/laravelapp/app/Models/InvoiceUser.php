<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceUser extends Model
{
    use HasFactory;

    protected $table = 'invoice_user'; // モデルが対応するテーブルの名前

    protected $fillable = [
        'invoice_id',
        'user_id',
        'billing_month',
    ];
}
