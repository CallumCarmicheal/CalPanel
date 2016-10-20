<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Administration - {{ config('app.name', 'CalPanel') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
        	'csrfToken' => csrf_token(),
        ]); ?>
    </script>

    @extends ('vendor.Styles')
    @yield('style', '')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/admin') }}">
                        {{ config('app.name', 'CalPanel') }} - Admin
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        <li class="divider-vertical"></li>

                        @if(!Request::is('admin/users'))
                            <li><a href="">Users</a></li>
                        @endif

                        <li><a href="#">Site Admin</a></li>
                        <li><a href="#">Logs</a></li>

                        @if (View::hasSection('navbar'))
                            <li class="divider-vertical"></li>
                            @yield('navbar')
                        @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        {{-- Logged in user side --}}
                        <li class="divider-vertical"></li>
                        <li><a href="{{ url('/home') }}">Back to Home</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <!-- JQuery 2.0.0 -->
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

    @extends ('vendor.Scripts')
    <script src="/js/app.js"></script>

    @yield('scripts', '')
</body>
</html>
