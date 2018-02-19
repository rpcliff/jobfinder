@extends('layouts.master')

@section('page.css')

@endsection

@section('content')

    <div class="row">
        
        <div class="col-sm-6">               

            @include('partials.errors')
            
            <div class="card">

                <h2 class="card-title text-center" style="padding-top:10px;">Add Work Experience</h2>

                <div class="card-body">
                    <form method="POST" action="{{ url('/profile/'.Auth::user()->id.'/add_experience') }}">

                        {{ csrf_field() }}

                        <div class="form-group row">
                            <label for="company" class="col-sm-4 col-form-label">Company/Employer: </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="company" id="company" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="title" class="col-sm-4 col-form-label">Job Title: </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="title" id="title" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="started" class="col-sm-4 col-form-label">Started: </label>
                            <div class="col-sm-5">
                                <input type="date" class="form-control" name="date_start" id="date_start" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="started" class="col-sm-4 col-form-label">Ended: </label>
                            <div class="col-sm-5">
                                <input type="date" class="form-control" name="date_end" id="date_end">
                            </div>
                            <div class="col-sm-3">
                                <div class="form-check" style="padding-top:5px;">
                                    <input class="form-check-input" type="checkbox" id="present" name="present" value="wtf">
                                    <label class="form-check-label" for="present">Present</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="started" class="col-sm-4 col-form-label">Job Description: </label>
                            <div class="col-sm-8">
                                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-lg btn-primary pull-right" style="font-size:0.8em;">Add Experience</button>
                    </form>
                </div>
            </div>

        </div>

        <div class="col-sm-6">
            <h2 class="text-center" style="padding-top:10px;">Your Experience</h2>
            
            @foreach($experiences as $experience)
                <div class="card" style="margin-top:10px;">
                    <div class="card-header">
                        <h5><strong class="card-title text-center">{{$experience->job_title}}</strong> at {{$experience->company}}</h5>
                    </div>

                    <div class="card-body">
                        
                        <h5><span class="badge badge-info">
                            @if($experience->present)
                                <strong>{{date('M d, Y', strtotime($experience->started))}}</strong> to <strong>Present</strong>
                            @else
                                <strong>{{date('M d, Y', strtotime($experience->started))}}</strong> to <strong>{{date('M d, Y', strtotime($experience->ended))}}</strong>
                            @endif
                        </span></h5>
                        {{$experience->description}}
                        
                        <form method="POST" action="{{ url('/profile/'.Auth::user()->id.'/experience/'.$experience->id.'/delete') }}">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <input type="submit" class="btn btn-sm btn-danger pull-right" value="Delete">
                        </form>
                    </div>
                </div>
            @endforeach
            
        </div>

    </div>

    <hr>

    <div class="row">

        <div class="col-md-6">
            <div class="form-group">
                <a href="{{ url('/profile/'.Auth::user()->id) }}" class="btn btn-danger btn-block">Back</a>
            </div>
        </div>
        <div class="col-md-6">

        </div>
    </div>

@endsection


@section('page_js')

@endsection