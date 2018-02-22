@extends('layouts.master')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="jumbotron">
                <h1 class="text-center">Welcome to JobFinder</h1>
                @if(!auth()->check())
                    <a href="{{ url('/login') }}" class="btn btn-lg btn-primary pull-right">Sign up Now!</a>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Some stats</h4>
                </div>
                <div class="card-body">
                    <p>
                        There are <strong>{{ App\JobOpening::all()->count() }}</strong> Job Openings listed!
                    </p>
                    <p>
                        There are <strong>{{ App\Company::all()->count() }}</strong> Companies registered!
                    </p>
                    <p>
                        There are <strong>{{ App\Seeker::all()->count() }}</strong> Job Seekers registered!
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
        
        </div>
    </div>
@endsection