<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use App\JobOpening;

class PageController extends Controller
{
    public function index()
    {
        $new_jobs = JobOpening::latest()->limit(5)->get();
        return view('pages.index', compact('new_jobs'));
    }
    
    public function companies()
    {
        $companies = Company::orderBy('created_at', 'desc')->get();
        return view('pages.companies', compact('companies'));
    }
    
    public function job_openings()
    {
        $jobs = JobOpening::orderBy('created_at', 'desc')->get();
        return view('pages.job_openings', compact('jobs'));
    }
}
