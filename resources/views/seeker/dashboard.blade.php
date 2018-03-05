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
                    @if(count(auth()->user()->type->applications)>0)
                        <a href="/applications" class="btn btn-sm btn-primary pull-right">View All</a>
                    @endif
                    Your Recent Applications
                </div>
                <div class="card-body">
                    @if(count(auth()->user()->type->applications)==0)
                        <div class="alert alert-warning">You have not applied to any jobs yet!</div>
                    @endif
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
                        <?php $app = auth()->user()->type->application(auth()->user()->id,$job->id) ?>
                        @if(isset($app) && count($app)==0)
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-md-3">
                                        <?php $img_src = '/storage/company_images/company'.$job->company->user_id.'.png'; ?>
                                        @if(file_exists(public_path($img_src)))
                                            <img style="width:80px;height:80px;" src="{{$img_src}}?={{ File::lastModified(public_path().'/'.$img_src) }}">
                                        @else
                                            <img style='width:80px;height:80px;' src='/storage/company_images/noimage.png'>
                                        @endif
                                    </div>
                                    <div class="col-md-9">
                                        <strong>{{ $job->title }}</strong>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <span class="badge badge-pill badge-secondary pull-right">{{ $val }}%</span>

                                    </div>
                                </div>
                            </li>
                        @endif
                    @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection