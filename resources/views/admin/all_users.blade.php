@extends('layouts.admin')

@section('content')
    <h1 class="text-center">All Users</h1>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <ul class="list-group">
                @foreach($users as $user)
                    <li class="list-group-item">
                        <h3><span class="badge badge-secondary pull-right">
                        @if($user->user_type == 1)
                            Seeker
                        @elseif($user->user_type == 2)
                            Company
                        @else
                            Admin
                        @endif
                        </span>
                        <strong>
                            @if($user->user_type != 3)
                                {{ $user->type->name }}
                            @else
                                Master Administrator
                            @endif
                        </strong>
                        </h3>
                        <p>{{ $user->email }}</p>
                    </li>
                    
                @endforeach
            </ul>
        </div>
    </div>

@endsection