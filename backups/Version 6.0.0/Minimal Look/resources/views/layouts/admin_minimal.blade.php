<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Site Administration</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link rel=stylesheet href="/css/base.layout.css">


        <script>
            window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
            ]); ?>
        </script>
        
        @extends ('vendor.Styles')
        @yield('style', '')
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="top-right links">
                <a href="{{ url('/admin') }}">Administration Index</a>
                <a href="{{ url('/home') }}">Back to Home</a>
            </div>

            @yield('content')
        </div>

        <!-- JQuery 2.0.0 -->
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

        @extends ('vendor.Scripts')
        @yield('scripts', '')
    </body>
</html>
