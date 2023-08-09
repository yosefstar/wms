<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    // 他の関連性やメソッドを追加する可能性があります
}
