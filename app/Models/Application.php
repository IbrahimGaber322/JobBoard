<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'emp_id', 'job_id', 'status']; 

    public function job()
    {
        return $this->belongsTo(jobportal::class, 'job_id');
    }

    public function candidate()
    {
        return $this->belongsTo(User::class, 'user_id')->where('role', User::ROLE_CANDIDATE);
    }
}
