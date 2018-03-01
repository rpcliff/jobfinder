@extends('layouts.master')

@section('page.css')

@endsection

@section('content')

    <div class="row">

        <div class="col-sm-6">               

            @include('partials.errors')
            
            <div class="card">

                <h2 class="card-title text-center" style="padding-top:10px;">Add Education</h2>

                <div class="card-body">
                    <form method="POST" action="{{ url('/profile/'.Auth::user()->id.'/add_education') }}">

                        {{ csrf_field() }}
                        
                        <div class="form-group row">
                            <label for="university" class="col-sm-4 col-form-label">University: </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="university" id="university" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="degree" class="col-sm-4 col-form-label">Degree: </label>
                            <div class="col-sm-8">
                                <select class="form-control" id="degree" name="degree">
                                    @foreach($degrees as $degree)
                                        <option value="{{ $degree->id }}">{{ $degree->education }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="title" class="col-sm-4 col-form-label">Degree Title: </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="title" id="title" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="achieved" class="col-sm-4 col-form-label">Date Achieved: </label>
                            <div class="col-sm-5">
                                <input type="date" class="form-control" name="achieved" id="achieved" required>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-lg btn-primary pull-right" style="font-size:0.8em;">Add Education</button>
                    </form>
                </div>
            </div>

        </div>

        <div class="col-sm-6">
            <h2 class="text-center" style="padding-top:10px;">Your Education</h2>
            
            @foreach($educations as $education)
                <div class="card" style="margin-top:10px;">
                    <div class="card-header">
                        <h5><strong class="card-title text-center">{{$education->education->education}}</strong> at {{$education->university}}</h5>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ url('/profile/'.Auth::user()->id.'/education/'.$education->id.'/delete') }}">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <input type="submit" class="btn btn-sm btn-danger pull-right" value="Delete">
                        </form>
                        
                        <h5><span class="badge badge-info">
                                <strong>{{date('M d, Y', strtotime($education->achieved))}}</strong>
                        </span></h5>
                        
                        <p>
                            {{$education->title}}
                        </p>
                        
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