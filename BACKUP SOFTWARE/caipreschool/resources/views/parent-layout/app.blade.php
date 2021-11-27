<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <title>Parents Area</title>
        <!-- Favicons -->
        <link href="{{ url('public/frontend/images/favicon.png') }}" rel="icon">
        <link href="{{ url('public/frontend/images/apple-touch-icon.png') }}" rel="apple-touch-icon">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ url('public/frontend/css/style.css') }}">
        <script src="{{ url('public/frontend/vendor/jquery/dist/jquery.min.js') }}"></script>
        <script src="{{ url('public/frontend/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    </head>
    <body>
        @include('parent-layout.navbars.navbar')
        
        @yield('content')
    </body>

</html>