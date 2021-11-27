<html>
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
      
        <title>Online CAI for Public Preschool Students</title>
        <meta content="" name="description">
        <meta content="" name="keywords">
      
        <!-- Favicons -->
        <link href="{{ url('public/frontend/images/favicon.png') }}" rel="icon">
        <link href="{{ url('public/frontend/images/apple-touch-icon.png') }}" rel="apple-touch-icon">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ url('public/frontend/css/style.css') }}">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="{{ url('public/frontend/js/bootstrap.bundle.min.js') }}"></script>
    </head>
    <body>
        <!--Navbar -->
          <nav class="mb-1 navbar navbar-expand-lg text-white-50 nav-menu">
            <a class="navbar-brand" href="."><img src="{{ url('public/frontend/images/apple-touch-icon.png') }}" width="50px"></a>

            <button class="navbar-toggler navbar-dark" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-555"
              aria-controls="navbarSupportedContent-555" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>

            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent-555">
              <ul class="navbar-nav ml-auto nav-flex-icons nav-menu">
                <li class="nav-item">
                  <a class="nav-link text-center" href="{{ route('register') }}">Create an account
                    <span class="sr-only"></span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-center" href="{{ route('login') }}">Sign In
                    <span class="sr-only"></span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-center" href="#">FAQs</a>
                </li>
              </ul>
            </div>
          </nav>
          <!-- Navbar ends-->
            
              <div class="jumbotron text-dark">
                <div class="jumbotron-no-background text-white ">
                    <div class="container-fluid text-center text-lg-left">
                      <div class="row">
                        <div class="col-lg-8">
                            <h4 class="jumbotron-title" >Make learning awesome!</h4>
                            <p class="lead" style="font-size: 20px; font-weight: bold">
                              Online Computer Aided Instruction for Public Preschool Students delivers
                              learning materials from Department of Social Welfare and Development right away with the use of technology.
                            </p>
                            <a class="btn btn-lg btn-design text-center" href="{{ route('register') }}" role="button">Get started</a>  
                        </div>
                        <div class="col-lg-2">
                          <img src="{{ url('public/frontend/images/banner-try.gif') }}" class ="d-none d-sm-block d-md-block d-lg-block d-xl-block" alt="">
                        </div>
                      </div>
                     
                        
                   
                    </div>
                </div>
             </div>
    </body>
    <!-- Footer -->
    <footer class="footer text-white text-center text-lg-start">
      <!-- Copyright -->
      <div class="text-center p-2 footer-text" style="background-color: #000000;">
        © 2021 Copyright: Online Computer Aided Instruction for Public Preschool Students
      </div>
      <!-- Copyright -->
    </footer>
</html>