<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jobportal extends Model
{
    use HasFactory;
    const WORK_TYPE_REMOTE = 'remote';
    const WORK_TYPE_ONSITE = 'onsite';
    const WORK_TYPE_HYBRID = 'hybrid';

    protected $fillable = [
        'title',
        'desc',
        'experience_level',
        'responsibilities',
        'skills',
        'salary_range',
        'date',
        'category',
        'location',
        'work_type',
        'status',
        'emp_id',
        'no_of_candidates',
        'deadline',
     
    ];

    public function employer()
    {
        return $this->belongsTo(User::class, 'emp_id')->where('role', User::ROLE_EMPLOYER);
    }

    protected $casts = [
        'date' => 'datetime',
        'deadline' => 'datetime',
    ];

    public function isRemote()
    {
        return $this->work_type === self::WORK_TYPE_REMOTE;
    }

    public function isOnsite()
    {
        return $this->work_type === self::WORK_TYPE_ONSITE;
    }

    public function isHybrid()
    {
        return $this->work_type === self::WORK_TYPE_HYBRID;
    }
}
