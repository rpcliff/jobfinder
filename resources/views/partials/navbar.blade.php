<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">{{ config('app.name') }}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample07" aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExample07">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item {{ (Request::is('/') ? 'active' : '') }}">
                    <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item {{ (Request::is('job_openings') ? 'active' : '') }}">
                    <a class="nav-link" href="{{ url('/job_openings') }}">Job Openings</a>
                </li>
                <li class="nav-item {{ (Request::is('companies') ? 'active' : '') }}">
                    <a class="nav-link" href="{{ url('/companies') }}">Companies</a>
                </li>

            </ul>
            
            <ul class="nav navbar-nav navbar-right">
                <li class="nav-item dropdown">
                    @if(Auth::check())
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown07" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            
                            @if(auth()->user()->user_type == 1)
                                <?php $img_src = '/storage/seeker_images/seeker'.auth()->user()->id.'.png'; ?>
                                @if(file_exists(public_path($img_src)))
                                    <img class="rounded-circle" style="width:40px;height:40px;padding-top:0px;padding-bottom:0px;" src="{{$img_src}}?={{ File::lastModified(public_path().'/'.$img_src) }}">
                                @else
                                    <img class="rounded-circle" style="width:40px;height:40px;padding-top:0px;padding-bottom:0px;" src='/storage/seeker_images/noimage.png'>
                                @endif
                            @elseif(auth()->user()->user_type == 2)
                                <?php $img_src = '/storage/company_images/company'.auth()->user()->id.'.png'; ?>
                                @if(file_exists(public_path($img_src)))
                                    <img class="rounded-circle" style="width:40px;height:40px;padding-top:0px;padding-bottom:0px;" src="{{$img_src}}?={{ File::lastModified(public_path().'/'.$img_src) }}">
                                @else
                                    <img class="rounded-circle" style="width:40px;height:40px;padding-top:0px;padding-bottom:0px;" src='/storage/company_images/noimage.png'>
                                @endif
                            @endif

                            &nbsp;{{ Auth::user()->type->name }}</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown07">
                            <a class="dropdown-item" href="{{ url('/dashboard') }}">Dashboard</a>
                            @if(auth()->user()->user_type==1)
                                <a class="dropdown-item" href="{{ url('/applications') }}">Your Applications</a>
                            @elseif(auth()->user()->user_type==2)
                                <a class="dropdown-item" href="{{ url('/company_jobs') }}">Your Job Openings</a>
                            @endif
                            <a class="dropdown-item" href="{{ url('/profile/'.Auth::user()->id) }}">Profile</a>
                            <a class="dropdown-item" href="#">Account</a>
                            <a class="dropdown-item" href="{{ url('/logout') }}">Logout</a>
                        </div>
                    @else
                        <a class="nav-link" href="/login">Login/Register</a>
                    @endif
                </li>
            </ul>
        </div>
    </div>
</nav>