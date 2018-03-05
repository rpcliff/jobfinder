@extends('layouts.master')

@section('content')

    <h1>Edit Account</h1>

    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    Account Details
                </div>
                <div class="card-body">
                    <form method="post">
                        <div class="form-group row">
                            <label for="account_email" class="col-sm-4 col-form-label">Account Email</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" name="account_email" id="account_email" value='{{ $info->email }}'>
                            </div>
                        </div>
                        <p>
                            <strong>Change Password</strong>
                        </p>
                        <div class="form-group row">
                            <label for="current_pw" class="col-sm-4 col-form-label">Old Password</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" name="current_pw" id="current_pw">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="new_pw" class="col-sm-4 col-form-label">New Password</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" name="new_pw" id="new_pw">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="confirm_pw" class="col-sm-4 col-form-label">Confirm New Password</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" name="confirm_pw" id="confirm_pw">
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <a href="{{ url('/profile/'.$user_id.'/account') }}" class="btn btn-danger btn-block">Cancel</a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block">Update</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection