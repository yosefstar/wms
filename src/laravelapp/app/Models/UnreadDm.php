<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnreadDm extends Model
{
    use HasFactory;

    protected $table = 'unread_dm';

    protected $fillable = [
        'user_id',
        'dm_id',
    ];
}
