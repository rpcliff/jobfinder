@extends('layouts.master')

@section('content')

    <div class="row">
        <div class="col-md-12">
            @foreach($jobs as $job)
        
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h3><span class="badge badge-light pull-right">{{ $job->created_at->diffForHumans() }}</span>
                        <strong>{{ $job->title }}</strong> at {{ $job->company->name }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2">
                                <?php $img_src = '/storage/company_images/company'.$job->company_id.'.png'; ?>
                                @if(file_exists(public_path($img_src)))
                                    <img style="width:150px;height:150px;" src="{{$img_src}}?={{ File::lastModified(public_path().'/'.$img_src) }}">
                                @else
                                    <img style='width:150px;height:150px;' src='/storage/company_images/noimage.png'>
                                @endif
                            </div>
                            <div class="col-md-10">
                                <p><strong>Job Description: </strong>{{ $job->description }}</p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p><strong>Job Type: </strong>{{ $job->type }}</p>
                                        <p><strong>Education: </strong>{{ $job->education }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        @if(empty($job->salary))
                                            <p><strong>Salary: </strong>N/A</p>
                                        @else
                                            <p><strong>Salary: </strong>${{ number_format($job->salary,0) }}</p>
                                        @endif
                                        <p><strong>Experience: </strong>{{ $job->experience }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ url('/job/'.$job->id) }}" class="btn btn-sm btn-primary pull-right">View Job</a>
                        <h5><span class="badge badge-secondary"><strong>Openings: </strong>{{ $job->openings }}</span></h5>
                    </div>
                </div>
                <br>
            @endforeach
        </div>
    </div>

@endsection