@extends('layouts.master')

@section('content')

    <div class="row">
        <div class="col-md-12">
            @foreach($jobs as $job)
        
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h3><span class="badge badge-light pull-right">{{ $job->created_at->diffForHumans() }}</span>
                        <strong>{{ $job->title }}</strong></h3>
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
                                <h4 class="text-center pt-2"><strong>{{ $job->company->name }}</strong></h4>
                            </div>
                            <div class="col-md-10">
                                <p><strong>Job Description: </strong>{{ $job->description }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ url('/job/'.$job->id) }}" class="btn btn-md btn-primary pull-right">View Job</a>
                        <strong>Openings: </strong>{{ $job->openings }}
                    </div>
                </div>
                <br>
            @endforeach
        </div>
    </div>

@endsection