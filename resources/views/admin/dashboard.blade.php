@extends('layouts.master')

@section('content')

    <h1>Admin Dashboard</h1>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>General Info</h4>
                </div>
                <div class="card-body">
                    
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Newest Users</h4>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach($users as $user)
                            <li class="list-group-item">
                                {{ $user->type->name }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Newest Jobs</h4>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach($jobs as $job)
                            <li class="list-group-item">
                                {{ $job->title }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection