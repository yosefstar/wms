<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class Job extends Model
{
    use HasFactory;

    protected $table = 'jobs';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'job_contractor_id',
        'job_client_id',
        'job_name',
        'job_details',
        'job_status',
        'job_reward',
        'job_travel_cost',
        'job_expense',
        'job_end_date',
        'job_check_date',
    ];

    protected $casts = [
        'job_status' => 'integer',
        'job_reward' => 'integer',
        'job_travel_cost' => 'integer',
        'job_expense' => 'integer',
    ];

    // 請負業者のニックネームを取得する関数
    public function contractorNickname()
    {
        $contractor = User::find($this->job_contractor_id);
        return $contractor ? $contractor->user_nickname : 'Unknown Contractor';
    }

    public function jobFiles()
    {
        return $this->hasMany(JobFile::class);
    }

    public function isEditableByCurrentUser()
    {
        // 管理者ユーザーは常に編集可能
        if (Auth::user()->user_type === 1) {
            return true;
        }

        // ユーザーの場合は自分の案件のみ編集可能
        return $this->job_contractor_id === Auth::id();
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'job_contractor_id');
    }
}
