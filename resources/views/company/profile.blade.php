@extends('layouts.master')

@section('content')

    <div class="row">
        <div class="col-md-3">
        <?php $img_src = '/storage/company_images/company'.$info->user_id.'.jpg'; ?>
        @if(file_exists(public_path($img_src)))
            <img style="width:250px;height:250px;" src="{{$img_src}}?={{ File::lastModified(public_path().'/'.$img_src) }}">
        @else
            <img style='width:250px;height:250px;' src='/storage/company_images/noimage.jpg'>
        @endif
            
        
        </div>
        <div class="col-md-9">
            
            <p style="font-size:2em;">
                {{ $info->name }}
                @if(auth()->check() && $info->user_id == auth()->user()->id)
                    <a href="{{ url('/profile/'.$info->user_id.'/edit') }}" class="btn btn-sm btn-danger">Edit Profile</a>
                @endif
                <span class="float-right badge badge-primary" style="font-size:0.5em;">Joined: {{ $info->created_at->diffForHumans() }}</span>
            </p>
            <p>
                <strong>Description: </strong> 
                @if(!empty($info->description))
                    {{ $info->description }}
                @else
                    N/A
                @endif
            </p>
            <p>
                <strong>Location: </strong> 
                @if(!empty($info->city) && !empty($info->state))
                    {{ $info->city }}, {{ $info->state }} {{ $info->zipcode }}
                @else
                    N/A
                @endif
            </p>
            <p>
                <strong>Email: </strong> 
                {{ $info->user->email }}
            </p>
            <p>
                <strong>Phone: </strong> 
                @if(!empty($info->phone))
                    {{ $info->phone }}
                @else
                    N/A
                @endif
            </p>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                
                <div class="card-header bg-dark text-white">
                    @if(auth()->check() && auth()->user()->id == $info->user_id)
                        <a href="{{ url('/create_job') }}" class="btn btn-sm btn-danger pull-right">Create Job Opening</a>
                    @endif
                    <h3>Job Openings</h3>
                </div>
                
                <div class="card-body">
                    @if(count($jobs)==0)
                        <div class="alert alert-danger">
                            <h5 style="text-align: center;">No Job Openings have been added.</h5>
                        </div>
                    @endif
                    @foreach($jobs as $job)
                        <div class="card">
                            <div class="card-header">
                                <span class="badge badge-light pull-right">{{ $job->created_at }}</span>
                                {{ $job->title }}
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-10">
                                        {{ $job->description }}
                                    </div>
                                    <div class="col-md-2">
                                        @if(auth()->check() && $info->user_id == auth()->user()->id)
                                            <a href="{{ url('/job/'.$job->id.'/manage') }}" class="btn btn-sm btn-warning btn-block">Manage</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                    @endforeach
                </div>
                
            </div>
        </div>
    </div>

@endsection