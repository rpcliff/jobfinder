@extends('layouts.master')

@section('content')

    <div class="row">
        <div class="col-md-12">
            @foreach($companies as $company)
        
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <!--<h3><span class="badge badge-light pull-right">{{ $company->created_at->diffForHumans() }}</span>-->
                        <h3><span class="badge badge-light pull-right">{{ $company->city }}, {{ $company->state }}</span>
                        <strong>{{ $company->name }}</strong></h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2">
                                <?php $img_src = '/storage/company_images/company'.$company->user_id.'.png'; ?>
                                @if(file_exists(public_path($img_src)))
                                    <img style="width:120px;height:120px;" src="{{$img_src}}?={{ File::lastModified(public_path().'/'.$img_src) }}">
                                @else
                                    <img style='width:120px;height:120px;' src='/storage/company_images/noimage.png'>
                                @endif
                            </div>
                            <div class="col-md-10">
                                <h5>
                                    <div class="badge badge-secondary">{{$company->industry}}</div>
                                    <div class="badge badge-secondary">Founded {{$company->founded}}</div>
                                    <div class="badge badge-secondary">{{$company->size}} Employees</div>
                                </h5>
                                {{ $company->description }}
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ url('/profile/'.$company->user_id) }}" class="btn btn-sm btn-primary pull-right">View Company</a>
                        <strong>Job Openings: </strong>{{ count($company->job_openings) }}
                    </div>
                </div>
                <br>
            @endforeach
        </div>
    </div>

    {{ $companies->links('partials.pagination') }}

@endsection