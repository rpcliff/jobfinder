<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seeker extends Model
{
    protected $primaryKey = 'user_id';
    
    protected $fillable = [
        'user_id', 
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function seeker_skills()
    {
        //Has Many SeekerSkills with foreign key 'seeker_id'
        return $this->hasMany(SeekerSkill::class, 'seeker_id')->orderBy('rating','asc'); 
    }
    
    public function seeker_experience()
    {
        return $this->hasMany(SeekerExperience::class, 'seeker_id');
    }
    
    public function seeker_education()
    {
        return $this->hasMany(SeekerEducation::class, 'seeker_id');
    }
    
    public function applications()
    {
        return $this->hasMany(Application::class, 'seeker_id');
    }
    
    //Get a specific application
    public function application($seeker_id, $job_id)
    {
        return \App\Application::where('job_id',$job_id)->where('seeker_id',$seeker_id)->get();
    }
    
    public function highest_education($seeker_id)
    {
        return \App\SeekerEducation::where('seeker_id',$seeker_id)->orderBy('education_id','desc')->first();
    }
}
