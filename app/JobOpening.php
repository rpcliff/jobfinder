<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobOpening extends Model
{
    protected $primaryKey = 'id';
    
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'user_id');
    }
    
    public function job_skills()
    {
        //Has Many Job Skills with foreign key 'job_id'
        return $this->hasMany(JobSkill::class, 'job_id');
    }
    
    public function applications()
    {
        return $this->hasMany(Application::class, 'job_id');
    }
    
    public function education_level()
    {
        return $this->belongsTo(Education::class, 'education', 'id');
    }
}
