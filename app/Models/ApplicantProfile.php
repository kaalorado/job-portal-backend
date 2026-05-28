<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;



#[Fillable([
    'user_id',
    'phone',
    'bio',
    'skills',
    'experience',
    'resume_path'
])]
class ApplicantProfile extends Model
{
    public function user() {
        return $this->belongsTo(User::class);
    }

    
    // one appplican can apply for many jobs 
    public function applications(){
        return $this->hasMany(Application::class);
    }
}
