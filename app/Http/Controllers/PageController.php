<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use App\JobOpening;

class PageController extends Controller
{
    public function index()
    {
        return view('pages.index');
    }
    
    public function companies()
    {
        $companies = Company::all();
        return view('pages.companies', compact('companies'));
    }
    
    public function job_openings()
    {
        $jobs = JobOpening::all();
        return view('pages.job_openings', compact('jobs'));
    }
}
