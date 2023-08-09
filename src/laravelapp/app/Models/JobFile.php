<?php

// app/Models/JobFile.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobFile extends Model
{
    protected $fillable = [
        'job_id',
        'user_id',
        'file_name',
        'file_path',
        'file_status',
    ];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
