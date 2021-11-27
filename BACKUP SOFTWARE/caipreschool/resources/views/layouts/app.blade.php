<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard - Aidaptive</title>
    <!-- Favicon -->
    <link rel="icon" href="{{ url('public/frontend/img/brand/favicon.png') }}">
    
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <!-- Icons -->
    <link rel="stylesheet" href="{{ url('public/frontend/vendor/nucleo/css/nucleo.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ url('public/frontend/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}" type="text/css">
    <!-- Page plugins -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.0/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{ url('public/frontend/vendor/nucleo/css/nucleo.css') }}">
    <link rel="stylesheet" href="{{ url('public/css/video-js.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ url('public/frontend/css/argon.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ url('public/css/toastify.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ url('public/css/sweetalert2.min.css') }}" type="text/css">
    
  </head>

  <body>
    @include('layouts.navbars.sidebar')
    <!-- Main content -->
    <div class="main-content" id="panel">
      @include('layouts.navbars.navbar')
      
      @yield('content')
      
    </div>
    <!-- Argon Scripts -->
    <!-- Core -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="{{ url('public/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('public/js/video.min.js') }}"></script>
    <script src="{{ url('public/js/toastify.js') }}"></script>
    <script src="{{ url('public/js/sweetalert2.min.js') }}"></script>
    <script src="{{ url('public/frontend/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('public/frontend/vendor/js-cookie/js.cookie.js') }}"></script>
    <script src="{{ url('public/frontend/vendor/jquery.scrollbar/jquery.scrollbar.min.js') }}"></script>
    <script src="{{ url('public/frontend/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js') }}"></script>
    <!-- Optional JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.min.js" integrity="sha512-GMGzUEevhWh8Tc/njS0bDpwgxdCJLQBWG3Z2Ct+JGOpVnEmjvNx6ts4v6A2XJf1HOrtOsfhv3hBKpK9kE5z8AQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <!-- Argon JS -->
    <script src="{{ url('public/frontend/js/argon.js') }}"></script>
    @yield('ajaxScript')
  </body>

</html>