<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use App\JobOpening;
use App\Seeker;

class PageController extends Controller
{
    public function index()
    {
        $new_jobs = JobOpening::latest()->limit(5)->get();
        $new_seekers = Seeker::latest()->limit(5)->get();
        return view('pages.index', compact('new_jobs','new_seekers'));
    }
    
    public function companies()
    {
        $companies = Company::orderBy('created_at', 'desc')->paginate(7);
        return view('pages.companies', compact('companies'));
    }
    
    public function job_openings()
    {
        $jobs = JobOpening::orderBy('created_at', 'desc')->paginate(7);
        return view('pages.job_openings', compact('jobs'));
    }
}
