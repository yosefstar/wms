<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use App\Models\Invoice;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // テーブル名
    protected $table = 'users';

    // 可変項目
    protected $fillable = [
        'user_name',
        'password',
        'user_type',
        'user_nickname',
        'user_icon',
        'stop_flag',
        'postal_code',
        'prefecture_id',
        'city',
        'street_address',
        'building_and_room',
        'user_phone_number',
        'email',
        'bank_name',
        'branch_name',
        'bank_account_type',
        'bank_account_number',
        'bank_account_holder_name',
    ];

    // パスワードのハッシュ
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    // ユーザーアイコンの保存
    public function storeUserIcon($file)
    {
        $path = $file->store('public/user_icons');
        $this->user_icon = Storage::url($path);
        $this->save();
    }

    public function invoices()
    {
        return $this->belongsToMany(Invoice::class, 'invoice_user')
            ->withPivot('billing_month');
    }
}
