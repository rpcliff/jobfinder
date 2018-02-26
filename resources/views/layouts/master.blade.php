<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        
        <!-- Custom styles for this template -->
        <link href="{{url('css/main.css')}}" rel="stylesheet" type="text/css">
        
        <!-- FONT AWESOME -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        @yield('page_css')
        
        <title>Laravel</title>

    </head>
    <body>

        @include('partials.navbar')
        
        <main role="main">
            <div class="container">
                @yield('content')
            </div>
        </main>
        
        <footer class="footer bg-dark text-white">
          <div class="container">
            
            <span class="">	&copy; 2018 JobFinder</span>
          </div>
        </footer>
        
        <script src="{{ asset('js/app.js') }}"></script>
        
        @yield('page_js')
    </body>
</html>
