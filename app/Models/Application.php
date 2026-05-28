<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable([
    'job_id',
    'applicant_profile_id',
    'cover_letter',
    'status'
])]
class Application extends Model
{

        // each applicant belong to 1 job 
    public function job() {
        return $this->belongsTo(Job::class);
    }


    //Each application belongs to one applicant
    public function applicantProfile() {
        return $this->belongsTo(ApplicantProfile::class);
    }
}
