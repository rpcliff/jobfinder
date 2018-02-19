@extends('layouts.master')

@section('content')

    <div class="row">

        <div class="col-md-3">
        
            <?php $img_src = '/storage/company_images/company'.$job->company_id.'.jpg'; ?>
            @if(file_exists(public_path($img_src)))
                <img style="width:250px;height:250px;" src="{{$img_src}}?={{ File::lastModified(public_path().'/'.$img_src) }}">
            @else
                <img style='width:250px;height:250px;' src='/storage/company_images/noimage.jpg'>
            @endif
            
            <a href="{{ url('/profile/'.$job->company_id) }}" class="btn btn-primary btn-block" style="margin-top:10px;">View Company</a>
        </div>
        <div class="col-md-9">
            
            <p style="font-size:2em;">
                {{ $job->title }}
                <span class="float-right badge badge-primary" style="font-size:0.5em;">Created: {{ $job->created_at->diffForHumans() }}</span>
            </p>
            <p style="font-size:1.5em;">
                <span class="badge badge-secondary">{{ $job->type }}</span>
                <span class="badge badge-secondary">Education: {{ $job->education }}</span>
                <span class="badge badge-secondary">Experience: {{ $job->experience }}</span>
            </p>
            <p>
                <strong>Description: </strong> {{ $job->description }}
            </p>
            <p>
                <strong>Openings: </strong> {{ $job->openings }}
            </p>
            <p>
                <strong>Salary: </strong>
                @if(empty($job->salary) || $job->salary == 0)
                    N/A
                @else
                    {{ $job->salary }}
                @endif
            </p>
            <p>
                <strong>Company: </strong> {{ $job->company->name }}
            </p>
            <p>
                <strong>Location: </strong> 
                @if(!empty($job->company->city) && !empty($job->company->state))
                    {{ $job->company->city }}, {{ $job->company->state }} {{ $job->company->zipcode }}
                @else
                    N/A
                @endif
            </p>
            <p>
                <strong>Email: </strong> 
                {{ $job->company->user->email }}
            </p>
            <p>
                <strong>Phone: </strong> 
                @if(!empty($job->company->phone))
                    {{ $job->company->phone }}
                @else
                    N/A
                @endif
            </p>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            @foreach($applications as $application)
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h3><span class="badge badge-light pull-right">Submitted: {{ $application->created_at->diffForHumans() }}</span>
                        <strong>{{ $application->seeker->name }}</strong></h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2">
                                <?php $img_src = '/storage/seeker_images/seeker'.$application->seeker_id.'.jpg'; ?>
                                @if(file_exists(public_path($img_src)))
                                    <img style="width:150px;height:150px;" src="{{$img_src}}?={{ File::lastModified(public_path().'/'.$img_src) }}">
                                @else
                                    <img style='width:150px;height:150px;' src='/storage/seeker_images/noimage.jpg'>
                                @endif
                            </div>
                            <div class="col-md-10">
                                <p><strong>Phone: </strong>{{ $application->seeker->phone }}</p>
                                <p><strong>Location: </strong>{{ $application->seeker->city }}, {{ $application->seeker->state }} {{ $application->seeker->zipcode }}</p>
                                <p><strong>Age: </strong>{{ $application->seeker->age }}</p>
                                
                                @foreach($application->seeker->seeker_skills as $skill)
                                    <span class="badge badge-pill badge-primary">{{ $skill->rating }} - {{ $skill->skill->name }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="" class="btn btn-md btn-danger pull-right ml-1">Remove Application</a>
                        <a href="{{ url('/job/'.$application->job->id) }}" class="btn btn-md btn-primary pull-right">View Profile</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <hr>
    <div class="row">
        
        <div class="col-md-6">
            <div class="form-group">
                <a href="{{ URL::previous() }}" class="btn btn-danger btn-block">Back</a>
            </div>
        </div>

    </div>

@endsection