@extends('layouts.master')

@section('content')

    <h3>Companies</h3>
    <hr>
<!--
    <form method="POST" action="{{ url('/companies') }}">
    <div class="row">

        <div class="col-md-6">
            
                {{ csrf_field() }}
                <div class="form-group row">
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="search" name="search">
                    </div>
                    <div class="col-sm-3">
                        <select class="form-control" id="search_type" name="search_type">
                            <option>Name</option>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <input type="submit" class="btn btn-secondary btn-block" value="Search">
                    </div>
                </div>
                <div class="form-group row">
                    @if(Session::has('query'))
                        <div class="col-sm-9">
                            <strong>Search: </strong>{{ Session::get('query') }}
                        </div>
                        <div class="col-sm-3">
                            <a href="{{ url('/companies') }}" class="btn btn-danger btn-sm btn-block">Clear</a>
                        </div>
                    @else
                        <div class="col-sm-12 pb-2">
                        
                        </div>
                    @endif
                </div>
            
        </div>
        <div class="col-md-6">
            <form method="POST" action="{{ url('/companies/order') }}" id="order_form">
                <div class="form-group row">
                    <div class="col-sm-12">
                        <select class="form-control pull-right" style="width:150px;" id="order" name="order">
                            <option {{ Session::has('order')?((Session::get('order')=='Newest Joined')?'selected':''):''}}>Newest Joined</option>
                            <option {{ Session::has('order')?((Session::get('order')=='Oldest Joined')?'selected':''):''}}>Oldest Joined</option>
                            <option {{ Session::has('order')?((Session::get('order')=='Job Openings')?'selected':''):''}}>Job Openings</option>
                        </select>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </form>
-->
    <div class="row">
        <div class="col-md-12">
            @foreach($companies as $company)
                
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        @if(isset($company->created_at))
                                <!--<h3><span class="badge badge-light pull-right">{{ $company->created_at }}</span>-->
                        @endif
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
                        <strong>Job Openings: </strong>
                        @if(Session::has('order') && Session::get('order')=='Job Openings')
                            {{ $company->job_openings }}
                        @else
                            {{ count($company->job_openings) }}
                        @endif
                    </div>
                </div>
                <br>
            @endforeach
        </div>
    </div>

    {{ $companies->links('partials.pagination') }}

@endsection

@section('page_js')

<script>
$("#order").change(function(){
    $('#order_form').submit();
});
</script>

@endsection