@extends('layouts.master')

@section('content')

    <h2>Job Openings - Admin</h2>
    <hr>
    <div class="row">
        <div class="col-md-12">
            @foreach($jobs as $job)
                <div class="card mb-1">
                    <div class="card-header">
                        <span class="badge badge-secondary pull-right" style="font-size:1em;">{{ $job->created_at->toDayDateTimeString() }}</span>
                        <h4 class="mb-0">
                            <?php $img_src = '/storage/company_images/company'.$job->company->user_id.'.png'; ?>
                            @if(file_exists(public_path($img_src)))
                                <img style="width:50px;height:50px" src="{{$img_src}}?={{ File::lastModified(public_path().'/'.$img_src) }}">
                            @else
                                <img style='width:50px;height:50px;' src='/storage/seeker_images/noimage.png'>
                            @endif
                            <strong class="ml-2">{{ $job->title }}</strong> at {{ $job->company->name }}
                        </h4>
                    </div>
                    <div class="card-body">
                        <h4>
                            <a href="" class="btn btn-sm btn-danger pull-right">Delete</a>
                            <a href="{{ url('/job/'.$job->id) }}" class="btn btn-sm btn-primary pull-right mr-1">View Job</a>
                            <span class="badge badge-secondary">{{ $job->type }}</span>
                            <span class="badge badge-secondary">{{ $job->openings }} Openings</span>
                            <span class="badge badge-secondary">Education: {{ $job->education }}</span>
                            <span class="badge badge-secondary">Experience: {{ $job->experience }}</span>
                            <span class="badge badge-secondary">Salary: 
                                @if(empty($job->salary))
                                    N/A
                                @else
                                    ${{ number_format($job->salary,0) }}
                                @endif
                            </span>
                        </h4>
                        <p>{{ $job->description }}</p>
                        <div class="row">
                            <div class="col-md-12">
                                <h5>
                                <strong class="mr-1">Skills: </strong>
                                @foreach($job->job_skills as $skill)
                                    <span class="badge badge-primary">{{ $skill->skill->name }}</span>
                                @endforeach
                                </h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-2">
                                <h5 class="mb-0">
                                <strong>Applicants: </strong>
                                @if(count($job->applications)==0)
                                    None
                                @endif
                                    <?php $first = 1; ?>
                                @foreach($job->applications as $application)
                                    @if($first > 1)
                                        <span>| </span>
                                    @endif
                                        <a href="{{ url('/profile/'.$application->seeker->user_id) }}">{{ $application->seeker->name }}</a>
                                    <?php $first++ ?>
                                @endforeach
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            
            @endforeach
        </div>
    </div>
    {{ $jobs->links('partials.pagination') }}
@endsection