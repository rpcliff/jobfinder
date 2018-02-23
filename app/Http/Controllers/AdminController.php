<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Skill;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        if(auth()->user()->user_type != 3)
           return back();
        
        return view('admin.index');
    }
    
    public function skills()
    {
        if(auth()->user()->user_type != 3)
            return back();
        
        $skills = Skill::all();
        
        $seeker_skills = \DB::table('seeker_skills')
            ->join('skills', 'seeker_skills.skill_id','=','skills.id')
            ->selectRaw('skill_id,name,category,AVG(rating) AS average_rating, COUNT(seeker_id) as num_seekers')
            ->whereRaw('seeker_skills.skill_id=skills.id')
            ->groupBy('skill_id')
            ->orderByRaw('average_rating DESC')->get();
        
        $job_skills = \DB::table('job_skills')
            ->join('skills', 'job_skills.skill_id','=','skills.id')
            ->selectRaw('skill_id,name,category,AVG(rating) AS average_rating, COUNT(job_id) as num_seekers')
            ->whereRaw('job_skills.skill_id=skills.id')
            ->groupBy('skill_id')
            ->orderByRaw('average_rating DESC')->get();

        return view('admin.skills', compact('skills', 'seeker_skills', 'job_skills'));
    }
}