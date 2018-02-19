<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobSkill extends Model
{
    protected $primaryKey = 'job_id';
    public $timestamps = false;
    
    public function skill()
    {
        return $this->belongsTo(Skill::class);
    }
    
    public function job_opening()
    {
        //Belongs to a JobOpening with foreign key 'job_id'
        return $this->belongsTo(JobOpening::class, 'job_id', 'id');
    }
}
