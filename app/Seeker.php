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
    
    public function suggestedJobs()
    {
        $jobs = \App\JobOpening::all();
        
        $test = array();
        /*foreach($jobs as $job)
        {
            $points = 0;
            foreach($job->job_skills as $job_skill)
            {
                $matched_skill = false;
                foreach(auth()->user()->type->seeker_skills as $seeker_skill)
                {
                    if($job_skill->skill_id == $seeker_skill->skill_id)
                    {
                        $matched_skill = true;
                        $skill_diff = ($job_skill->rating)-($seeker_skill->rating);
                    }
                }
            }
            //array_push($test,$job->id);
        }*/
        
        return \App\JobOpening::find($test);
    }
}
