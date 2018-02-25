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
        /*
        //\Session::forget('query');
        //\Session::forget('order');
        //\Session::flush();
        $companies = Company::orderBy('created_at','desc')->paginate(5);
        dd($companies);
        //return view('pages.companies', compact('companies'));
        
        $query = \DB::table('companies');

        if(\Session::has('query'))
        {
            $search = \Session::get('query');
            $var = '%'.$search.'%';
            $query->where('name','like',$var);
        }
        else
        {
            
        }
        
        if(\Session::has('order'))
        {
            $query->orderBy('created_at','desc');
        }
        
        $companies = $query->paginate(5);
        //dd($companies);*/
        $companies = Company::orderBy('created_at', 'desc')->paginate(5);

        return view('pages.companies', compact('companies'));
    }
    
    public function job_openings()
    {
        $jobs = JobOpening::orderBy('created_at', 'desc')->paginate(5);
        return view('pages.job_openings', compact('jobs'));
    }
    
    public function company_search(Request $request, Company $company)
    {
        $query = \DB::table('companies');

        if(isset($request->search))
        {
            $search = $request->search;
            $var = '%'.$search.'%';
            $query->where('name','like',$var);
            \Session::flash('query',$search);
        }
        
        if(isset($request->order))
        {
            $query->orderBy('created_at','desc');
            \Session::flash('order',$request->order);
        }
        
        $companies = $query->paginate(5);
        //dd($result);
        
        //$companies = Company::where('name','like',$var)->paginate(5);
        //$search = "Company Name containing '".$search."'";
        //\Session::flash('query',$search);
        return view('pages.companies', compact('companies'));
    }
    
    public function company_order(Request $request)
    {
        $order_by = $request->order;
        if($order_by == "Oldest Joined")
        {
            $companies = Company::orderBy('created_at', 'asc')->paginate(5);
        }
        else if($order_by == "Newest Joined")
        {
            $companies = Company::orderBy('created_at', 'desc')->paginate(5);
        }
        else if($order_by == "Job Openings")
        {
            $companies = \DB::table('companies')
                ->join('job_openings','companies.user_id','=','job_openings.company_id')
                ->selectRaw('name,user_id,industry,companies.description as description,count(job_openings.id) as job_openings,phone,contact_email,founded,size,city,state,zipcode,website,companies.created_at as created_at')
                ->groupBy('user_id')
                ->orderByRaw('job_openings DESC')->paginate(5);
            //return view('pages.companies', compact('companies'));
            //dd($companies);
        }
        else
        {
            $companies = Company::orderBy('created_at', 'desc')->paginate(5);
        }
        \Session::flash('order',$order_by);
        return view('pages.companies', compact('companies'));
    }
}
