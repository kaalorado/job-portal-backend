<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable([
    'employer_profile_id',
    'title',
    'description',
    'salary',
    'location',
    'job_type',
    'deadline'
])]

class Job extends Model
{
    public function employerProfile(){
        return $this->belongsTo(EmployerProfile::class);
    }


    // one job can have many appllicant
    public function applications(){
        return $this->hasMany(Application::class);
    }
}
