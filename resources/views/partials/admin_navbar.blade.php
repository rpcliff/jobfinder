<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">{{ config('app.name') }}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample07" aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExample07">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item {{ (Request::is('admin') ? 'active' : '') }}">
                    <a class="nav-link" href="{{ url('/admin') }}">Admin Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item {{ (Request::is('job_openings') ? 'active' : '') }}">
                    <a class="nav-link" href="">All Users</a>
                </li>
                <li class="nav-item {{ (Request::is('companies') ? 'active' : '') }}">
                    <a class="nav-link" href="">Companies</a>
                </li>
                <li class="nav-item {{ (Request::is('companies') ? 'active' : '') }}">
                    <a class="nav-link" href="">Seekers</a>
                </li>
                <li class="nav-item {{ (Request::is('companies') ? 'active' : '') }}">
                    <a class="nav-link" href="">Job Openings</a>
                </li>
                <li class="nav-item {{ (Request::is('companies') ? 'active' : '') }}">
                    <a class="nav-link" href="">Applications</a>
                </li>
                <li class="nav-item {{ (Request::is('admin/skills') ? 'active' : '') }}">
                    <a class="nav-link" href="{{ url('/admin/skills') }}">Skills</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="nav-item dropdown">

                        <a class="nav-link dropdown-toggle" href="#" id="dropdown07" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Admin</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown07">
                            <a class="dropdown-item" href="{{ url('/logout') }}">Logout</a>
                        </div>

                </li>
            </ul>
        </div>
    </div>
</nav>