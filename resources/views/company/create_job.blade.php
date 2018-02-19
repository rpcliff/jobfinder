@extends('layouts.master')

@section('page_css')

    <link href="{{ url('css/sortable.css') }}" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

@endsection

@section('content')

    <h2>Create Job Opening</h2>
    <hr>

    @include('partials.errors')

    <form method="POST" action="{{ url('/job/create') }}">
        {{ csrf_field() }}
        
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 style="text-align: center;">Job Information</h3>
                    </div>

                    <div class="card-body">

                        <div class="form-group row">
                            <label for="title" class="col-sm-4 col-form-label">Job Title: </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="title" id="title" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-sm-4 col-form-label">Job Description: </label>
                            <div class="col-sm-8">
                                <textarea class="form-control" name="description" id="description" rows="4" required></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="salary" class="col-sm-4 col-form-label">Salary: </label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="sal">$</span>
                                    </div>
                                    <input type="number" class="form-control" id="salary" name="salary" aria-describedby="sal">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="type" class="col-sm-4 col-form-label">Job Type: </label>
                            <div class="col-sm-8">
                                <select class="form-control" id="type" name="type">
                                        <option>Full Time</option>
                                        <option>Part Time</option>
                                        <option>As Needed</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="openings" class="col-sm-4 col-form-label">Job Openings: </label>
                            <div class="col-sm-3">
                                <input type="number" class="form-control" name="openings" id="openings" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="education" class="col-sm-4 col-form-label">Education Wanted: </label>
                            <div class="col-sm-8">
                                <select class="form-control" id="education" name="education">
                                        <option>Not neccesary</option>
                                        <option>Associates Degree</option>
                                        <option>Bachelors Degree</option>
                                        <option>Masters Degree</option>
                                        <option>Doctoral Degree</option>
                                        <option>Certification</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="experience" class="col-sm-4 col-form-label">Experience Wanted: </label>
                            <div class="col-sm-8">
                                <select class="form-control" id="experience" name="experience">
                                        <option>Not necessary</option>
                                        <option>1-3 Years</option>
                                        <option>3-5 Years</option>
                                        <option>5-10 Years</option>
                                        <option>10-20 Years</option>
                                </select>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-6">

                <div class="card">
                    <div class="card-header">
                        <h3 style="text-align: center;">Job Skills</h3> 
                    </div>

                    <div class="card-body">
                        <div class="skill_select_form" style="padding:10px;">
                            <select class="js-example-basic-single" id="skill_select" name="skill_select" style="width:400px;">
                                @foreach($skills_list as $skill)
                                    <option value='{{$skill->id}}'>{{$skill->name}}</option>
                                @endforeach
                            </select>

                            <button type="button" class="add-el btn btn-primary" style="font-size:0.8em;">Add Skill</button>
                        </div>

                        <ul id="list2" class="list_2">

                        </ul>

                    </div>

                    <div class="card-footer">
                        <h5 class="text-center" style="color:red; font-style:italic;">Order skills from most skilled (top) to least skilled (bottom).</h5>
                    </div>
                </div>

            </div>
        </div>
        <hr>
        <div class="row">

            <div class="col-md-6">
                <div class="form-group">
                    <a href="{{ url('/profile/'.auth()->user()->id) }}" class="btn btn-danger btn-block">Back</a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Create Job Opening</button>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('page_js')

    <script src="{{ asset('js/sortable.js') }}"></script>
    <script src="{{ asset('js/job_sortable.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
		  $('.js-example-basic-single').select2();
	   });
    </script>

@endsection