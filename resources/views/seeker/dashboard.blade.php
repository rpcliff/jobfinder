@extends('layouts.master')

@section('content')
    <h1>Seeker Dashboard</h1>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    Info
                </div>
                <div class="card-body">
                    <p><strong>Applications Submitted: </strong>{{ count(auth()->user()->type->applications) }}</p>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <a href="/applications" class="btn btn-sm btn-primary pull-right">View All</a>
                    Your Recent Applications
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach(auth()->user()->type->applications as $application)
                        
                            <li class="list-group-item">
                                <strong>{{ $application->job->title }}</strong> at {{ $application->job->company->name }}
                                <span class="badge badge-secondary badge-pill pull-right">{{ $application->created_at->diffForHumans() }}</span>
                            </li>
                        
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    Suggested Jobs
                </div>
                <div class="card-body">
                    <ul class="list-group">
                    @foreach($suggestedJobs as $key => $val)
                        <?php $job = App\JobOpening::find($key) ?>
                        <li class="list-group-item">
                            <span class="badge badge-pill badge-secondary pull-right">{{ $val }}%</span>
                            <strong>{{ $job->title }}</strong> at {{ $job->company->name }}
                        </li>
                    @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection