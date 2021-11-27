<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
    
        <title>Kids Area</title>
        <meta content="" name="description">
        <meta content="" name="keywords">
    
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
        <nav class="mb-1 navbar navbar-expand-lg text-white-50 nav-menu">
          

            <button class="navbar-toggler navbar-dark" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-555"
              aria-controls="navbarSupportedContent-555" aria-expanded="false" aria-label="Toggle navigation">

            </button>
            <ul class="navbar-nav ml-auto nav-flex-icons nav-menu">
              <a class="navbar-brand" href="{{ route('parent/home') }}"><img src="{{ url('public/frontend/images/user1.png') }}" width="50px"></a>
            </ul>
          </nav>

            <div class="container">
                <div class="row justify-content-center py-5">
                    <h3 class="add-student-header">Hello {{ $student->nickname }}!</h3>
                </div>

                <div class="row d-inline-flex text-center">

                    <div class="col-sm p-2 m-4 btn">
                      <a class ="card card-english text-decoration-none text-dark" href="{{ route('student/english_area') }}">
                        <div class ="card-body">
                            <img src ="{{ url('public/frontend/images/ABC.png') }}" class ="w-75">
                            <h1 class="card-title">English</h1>
                        </div>
                    </a>
                    </div>

                    <div class="col-sm p-2 m-4 btn">
                      <a class ="card card-math text-decoration-none text-dark" href="{{ route('student/math_area') }}">
                        <div class ="card-body">
                            <img src ="{{ url('public/frontend/images/MATH.png') }}" class ="w-75">
                            <h1 class="card-title">Math</h1>
                        </div>
                    </a>
                    </div>

                    <div class="col-sm p-2 m-4 btn">
                      <a class ="card card-science text-decoration-none text-dark" href="{{ route('student/science_area') }}">
                        <div class ="card-body">
                            <img src ="{{ url('public/frontend/images/SCIENCE.png') }}" class ="w-75">
                            <h1 class="card-title">Science</h1>
                        </div>
                    </a>
                    </div>
                </div>
                
            </div>
            <div class="fixed-bottom">
              <a href="#">
              <img src="https://s3-us-west-1.amazonaws.com/powr/chat/icons/icon1-1.svg" class="float-right p-2" height="75px">
            </a>
              </div>
    </body>
</html>