@extends('layouts.master')

@section('page_css')

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

@endsection

@section('content')

    <h3>Algorithm Tester</h3>
    <hr>
    <div class="row">
        <div class="col-md-12">
        
            <form method="GET" action="{{ url('/admin/algorithms') }}">
                <select class="js-example-basic-single" id="seeker" name="seeker" style="width:400px;">
                    @foreach($seekers as $seeker)
                            <option value='{{$seeker->user_id}}'>{{$seeker->name}}</option>
                    @endforeach
                </select>

                <button type="submit" class="btn btn-primary" style="font-size:0.8em;">Show Suggested Jobs</button>
            </form>
            
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            @if(isset($suggestedJobs))
                <h4><strong>Algorithm Time: </strong>{{ $time }} seconds</h4>
                <ul class="list-group">
                    @foreach($suggestedJobs as $key => $val)
                        <?php $job = App\JobOpening::find($key) ?>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-2">
                                    <?php $img_src = '/storage/company_images/company'.$job->company->user_id.'.png'; ?>
                                    @if(file_exists(public_path($img_src)))
                                        <img style="width:80px;height:80px;" src="{{$img_src}}?={{ File::lastModified(public_path().'/'.$img_src) }}">
                                    @else
                                        <img style='width:80px;height:80px;' src='/storage/company_images/noimage.png'>
                                    @endif
                                </div>
                                <div class="col-md-10">
                                    <strong>{{ $job->title }}</strong>
                                    <a href="{{ url('/job/'.$job->id) }}" class="btn btn-primary btn-sm pull-right">View</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <span class="badge badge-pill badge-secondary">Total Match: {{ $val[0] }}%</span>
                                    <span class="badge badge-pill badge-secondary">Skills: {{ $val[4] }}%</span>
                                    <span class="badge badge-pill badge-secondary">Skills Matched: {{ $val[1] }}</span>
                                    <span class="badge badge-pill badge-secondary">Meets Education:
                                        @if($val[2] == 0)
                                            No
                                        @else
                                            Yes
                                        @endif
                                    </span>
                                    <span class="badge badge-pill badge-secondary">Meets Experience:
                                        @if($val[3] == 0)
                                            No
                                        @else
                                            Yes
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>

@endsection

@section('page_js')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
		  $('.js-example-basic-single').select2();
	   });
    </script>

@endsection