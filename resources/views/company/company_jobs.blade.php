@extends('layouts.master')

@section('content')

    <h1 class="text-center">Your Job Openings</h1>
    <hr>
    <div class="row">
        <div class="col-md-12">
            @if(count($jobs)==0)
                <div class="alert alert-danger"><h3 class="text-center">You have no Job Openings.</h3></div>
            @endif
            
            @foreach($jobs as $job)
                <div class="card mb-2">
                    <div class="card-header bg-dark text-white">
                        <h4>{{ $job->title }}
                        <span class="badge badge-light pull-right">{{ $job->created_at->toDayDateTimeString() }}</span>
                        </h4>
                    </div>
                    <div class="card-body">
                        <h4>
                            <span class="badge badge-secondary text-white">{{ $job->type }}</span>
                            <span class="badge badge-secondary text-white">Education: {{ $job->education }}</span>
                            <span class="badge badge-secondary text-white">Experience: {{ $job->experience }}</span>
                        </h4>
                        <p><strong>Description: </strong>{{ $job->description }}</p>
                        <p><strong>Openings: </strong>{{ $job->openings }}</p>
                        <p><strong>Salary: </strong>
                        @if(!empty($job->salary))
                            {{ "$".number_format($job->salary,0) }}
                        @else
                            N/A
                        @endif
                        </p>
                    </div>
                    <div class="card-footer">
                        <span class='badge badge-dark text-white badge-pill'>{{ count($job->applications) }} Applications Submitted</span>
                        <a href="{{ url('/job/'.$job->id.'/manage') }}" class="btn btn-sm btn-warning pull-right">Manage</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection