@extends('layouts.master')

@section('content')

    <h1 class="text-center">Your Applications</h1>
    <hr>
    <div class="row">
        <div class="col-md-12">
        
            @foreach($applications as $application)
            
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h4><span class="badge badge-light pull-right">Applied: {{ $application->created_at->diffForHumans() }}</span>
                        <strong>{{ $application->job->title }}</strong> at {{ $application->job->company->name }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2">
                                <?php $img_src = '/storage/company_images/company'.$application->job->company_id.'.png'; ?>
                                @if(file_exists(public_path($img_src)))
                                    <img style="width:150px;height:150px;" src="{{$img_src}}?={{ File::lastModified(public_path().'/'.$img_src) }}">
                                @else
                                    <img style='width:150px;height:150px;' src='/storage/company_images/noimage.png'>
                                @endif
                            </div>
                            <div class="col-md-10">
                                <p><strong>Job Description: </strong>{{ $application->job->description }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="" class="btn btn-md btn-danger pull-right ml-1">Remove Application</a>
                        <a href="{{ url('/job/'.$application->job->id) }}" class="btn btn-md btn-primary pull-right">View Job</a>
                        <strong>Openings: </strong>{{ $application->job->openings }}
                    </div>
                </div>
                <br>
            
            @endforeach
        
        </div>
    </div>

@endsection