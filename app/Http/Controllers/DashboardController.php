<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Application;
use App\JobOpening;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        if(auth()->user()->user_type == 1)
        {
            $suggestedJobs = getSuggestedJobs(auth()->user()->id);

            return view('seeker.dashboard', compact('suggestedJobs'));
        }
        else if(auth()->user()->user_type == 2)
        {
            return view('company.dashboard');
        }
        else if(auth()->user()->user_type == 3)
        {
            return view('admin.dashboard');
        }
        
    }
    
    public function applications()
    {
        //Is a seeker
        if(auth()->user()->user_type != 1)
            return back();
        
        $applications = Application::where('seeker_id',auth()->user()->id)->get();
        return view('seeker.applications', compact('applications'));
    }
    
    public function company_jobs()
    {
        //Is a company
        if(auth()->user()->user_type != 2)
            return back();
        
        $jobs = JobOpening::where('company_id',auth()->user()->id)->orderBy('created_at','desc')->get();
        return view('company.company_jobs', compact('jobs'));
    }
}
