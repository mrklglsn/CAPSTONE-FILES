<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
    
        <title>Settings</title>
        <meta content="" name="description">
        <meta content="" name="keywords">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <!-- Favicons -->
        <link href="{{ url('public/frontend/images/favicon.png') }}" rel="icon">
        <link href="{{ url('public/frontend/images/apple-touch-icon.png') }}" rel="apple-touch-icon">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ url('public/frontend/css/style.css') }}">
        <link rel="stylesheet" href="{{ url('public/css/sweetalert2.min.css') }}">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/6.0.0-beta.1/dropzone.min.css" />
		<link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" rel="stylesheet"/>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.0/css/jquery.dataTables.min.css">
		
        <script src="{{ url('public/frontend/vendor/jquery/dist/jquery.min.js') }}"></script>
        <script src="{{ url('public/frontend/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ url('public/js/sweetalert2.min.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/6.0.0-beta.1/dropzone-min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
        <script src="{{ url('public/frontend/js/parent.js') }}"></script>
        <script src="{{ url('public/js/jquery.dataTables.min.js') }}"></script>
    </head>
    <body>
        <nav class="mb-1 navbar navbar-expand-lg nav-menu">
            <a class="btn" onclick="history.back(-1)"><i class="fa fa-arrow-left fa-2x"></i></a>

            <button class="navbar-toggler navbar-dark" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-555"
            aria-controls="navbarSupportedContent-555" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent-555">
            <ul class="navbar-nav ml-auto nav-flex-icons nav-menu">
                <li class="nav-item">
                    <a class="nav-link" href="" data-toggle="modal" data-target="#modalExit">Logout
                        <span class="sr-only"></span>
                    </a>
                </li>
            </ul>
            </div>
        </nav>
        <div class="modal fade" id="modalExit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header header-main text-white">
                        <h5 class="modal-title" id="exampleModalLabel">Logout</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to logout your account?
                    </div>
                    <div class="modal-footer footer-text">
                            <a  class="btn btn-danger" data-dismiss="modal">Close</a>
                            <a  class="btn btn-success" href="{{ route("logout") }}">Log out</a>
                    </div>
                </div>
            </div>
        </div>
        @yield('ajaxScript')