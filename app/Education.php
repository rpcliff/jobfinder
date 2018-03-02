<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    public $timestamps = false;
    
    public function seeker_educations()
    {
        return $this->hasMany(SeekerEducation::class, 'education_id');
    }
    
    public function job_educations()
    {
        return $this->hasMany(JobOpening::class, 'education');
    }
}
