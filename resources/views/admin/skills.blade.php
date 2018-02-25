@extends('layouts.master')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>All Skills</h3>
                </div>
                <div class="card-body">
                    @foreach($skills as $skill)
                        <span class="badge badge-secondary mt-1 mb-1" style="font-size:1em;">{{ $skill->name }}</span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3>Seeker Skills by Average Rating</h3>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                            <li class="list-group-item bg-light">
                                <div class="row">
                                    <div class="col-md-7">
                                        <strong>Skill</strong>
                                    </div>
                                    <div class="col-md-3">
                                        <strong>Seekers</strong>
                                    </div>
                                    <div class="col-md-2">
                                        <strong>Rating</strong>
                                    </div>
                                </div>
                            </li>
                        @foreach($seeker_skills as $seeker_skill)
                            <li class="list-group-item"> 
                                <div class="row">
                                    <div class="col-md-7">
                                        <strong>{{$seeker_skill->name}}</strong>
                                    </div>
                                    <div class="col-md-3">
                                        <span class="badge badge-primary badge-pill ml-3">{{$seeker_skill->num_seekers}}</span>
                                    </div>
                                    <div class="col-md-2">
                                        <span class="badge badge-dark">{{$seeker_skill->average_rating}}</span>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3>Job Skills by Average Rating</h3>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                            <li class="list-group-item bg-light">
                                <div class="row">
                                    <div class="col-md-7">
                                        <strong>Skill</strong>
                                    </div>
                                    <div class="col-md-3">
                                        <strong>Jobs</strong>
                                    </div>
                                    <div class="col-md-2">
                                        <strong>Rating</strong>
                                    </div>
                                </div>
                            </li>
                        @foreach($job_skills as $job_skill)
                            <li class="list-group-item"> 
                                <div class="row">
                                    <div class="col-md-7">
                                        <strong>{{$job_skill->name}}</strong>
                                    </div>
                                    <div class="col-md-3">
                                        <span class="badge badge-primary badge-pill ml-3">{{$job_skill->num_seekers}}</span>
                                    </div>
                                    <div class="col-md-2">
                                        <span class="badge badge-dark">{{$job_skill->average_rating}}</span>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

@endsection