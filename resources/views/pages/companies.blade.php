@extends('layouts.master')

@section('content')

    <div class="row">
        <div class="col-md-12">
            @foreach($companies as $company)
        
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h3><span class="badge badge-light pull-right">{{ $company->created_at->diffForHumans() }}</span>
                        <strong>{{ $company->name }}</strong></h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2">
                                <?php $img_src = '/storage/company_images/company'.$company->user_id.'.png'; ?>
                                @if(file_exists(public_path($img_src)))
                                    <img style="width:150px;height:150px;" src="{{$img_src}}?={{ File::lastModified(public_path().'/'.$img_src) }}">
                                @else
                                    <img style='width:150px;height:150px;' src='/storage/company_images/noimage.png'>
                                @endif
                            </div>
                            <div class="col-md-10">
                                {{ $company->description }}
                            </div>

                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ url('/profile/'.$company->user_id) }}" class="btn btn-md btn-primary pull-right">View Company</a>
                        <strong>Job Openings: </strong>{{ count($company->job_openings) }}
                    </div>
                </div>
                <br>
            @endforeach
        </div>
    </div>

@endsection