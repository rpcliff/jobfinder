<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    public function job_skills()
    {
        return $this->hasMany(JobSkill::class, 'skill_id');
    }
    
    public function seeker_skills()
    {
        return $this->hasMany(SeekerSkill::class, 'skill_id');
    }
}
