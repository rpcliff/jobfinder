<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Skill;
use App\JobOpening;
use App\JobSkill;
use App\Application;
use App\Education;

class JobController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'show']);
    }
    
    
    /*
     * AUTH: GUEST
     * SHOW JOB PAGE
     */
    public function show($job_id)
    {
        $job = JobOpening::find($job_id);
        if(count($job)==0)
            return back();
        
        return view('job.job', compact('job'));
    }
    
    /*
     * AUTH: COMPANY
     * SHOW CREATE JOB PAGE
     */
    public function show_create()
    {
        //Is a company
        if(auth()->user()->user_type != 2)
            return back();
    
        $skills_list = Skill::all();
        $educations = Education::all();
        return view('company.create_job', compact('skills_list', 'educations'));
    }
    
    /*
     * AUTH: COMPANY
     * CREATE JOB
     */
    public function create(Request $request)
    {
        //Is a company
        if(auth()->user()->user_type != 2)
            return back();
        
        $this->validate(request(), [
                'title' => 'required',
                'description' => 'required',
                'salary' => 'nullable|numeric',
                'openings' => 'required|numeric',
            ]);
        
        //Loop to verify all 5 skills were added, and load Array of skill id's
        $skills = array();
        for($i = 0; $i < 5; $i++)
        {
            $val = request('skill'.$i);
            if(is_numeric($val))
                array_push($skills,(int)$val);
            else
                return back()->withErrors(['field_name' => ['You must have 5 skills']]);
        }
        
        $job = new JobOpening;
        $job->company_id = auth()->user()->id;
        $job->title = $request->title;
        $job->description = $request->description;
        $job->openings = $request->openings;
        if(isset($request->salary)) $job->salary = $request->salary;
        else $job->salary = 0;
        $job->type = $request->type;
        $job->status = 0;
        $job->education = $request->education;
        $job->experience = $request->experience;
        
        $job->save();
        
        //Loop to update or insert skills into jobskills table
        for($i = 0; $i < 5; $i++)
        {
            $row = new JobSkill;
            $row->job_id = $job->id;
            $row->skill_id = $skills[$i];
            $row->rating = ($i+1);
            $row->save();
        }
        
        return redirect('/profile/'.auth()->user()->id);
    }
    
    /*
     * AUTH: COMPANY
     * MANAGE JOB
     */
    public function manage($job_id)
    {
        //Is a company
        if(auth()->user()->user_type != 2)
            return back();
        
        $job = JobOpening::find($job_id);
        
        //Does this job exist
        if(count($job)==0)
            return back();
        
        //Does this job belong to the company that created it
        if($job->company_id != auth()->user()->id)
            return back();
        
        //$applications = getSortedApplicants($job_id);
        $applications = getApplicants($job_id);

        return view('job.manage_job', compact('job', 'applications'));
    }
    
    
    /*
     * AUTH: SEEKER
     * APPLY TO JOB
     */
    public function apply($job_id)
    {
        //Is a seeker
        if(auth()->user()->user_type != 1)
            return back();
        
        $job = JobOpening::find($job_id)->get();
        
        //Does this job exist
        if(!isset($job))
            return back();
        
        //Has this user already applied
        $hasApplication = Application::where('job_id',$job_id)->where('seeker_id',auth()->user()->id)->get();

        if(count($hasApplication)>0)
            return back();
        
        //Does user have skills
        if(count(auth()->user()->type->seeker_skills)==0)
            return redirect()->back()->with('error_skills', 'You must have skills before applying to jobs!');
        
        $application = new Application;
        $application->seeker_id = auth()->user()->id;
        $application->job_id = $job_id;
        $application->save();
        
        return redirect()->back()->with('success', 'You have applied for this job!');
    }
    
    /*
     * AUTH: COMPANY
     * CLOSE JOB OPENING
     */
    public function close($job_id)
    {
        //Is a company
        if(auth()->user()->user_type != 2)
            return back();
        
        $job = JobOpening::find($job_id);
        
        //Does this job exist
        if(count($job)==0)
            return back();
        
        //Does this job belong to the company that created it
        if($job->company_id != auth()->user()->id)
            return back();
        
        $job->status = 1;
        $job->save();
        
        return redirect()->back()->with('success', 'Job Opening Closed! This Job will be remain accessible for 1 month.');
    }
}
