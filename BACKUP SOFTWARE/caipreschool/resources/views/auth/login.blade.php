<html>
  <head>
      <title>Login your Account</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      
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
  <a class="btn" href="{{ route("index") }}"><i class="fa fa-arrow-left fa-2x"></i></a>
    <div class="container">
      <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
          <div class="card card-signin my-5">
            <div class="card-body">
              <h5 class="card-title text-center">Login</h5>
              <form class="form-signin" action="{{ route('auth.check') }}" method="POST">
                @if (Session::get('success'))
                  <div class="alert alert-success">
                    {{ Session::get('success') }}
                  </div>
                @endif
                @if (Session::get('fail'))
                  <div class="alert alert-success">
                    {{ Session::get('fail') }}
                  </div>
                @endif
                @csrf
                <div class="form-label-group">
                  <input type="text" id="inputUsername" name="username" class="form-control" placeholder="Username" value="{{ old('username') }}" required>
                  <label for="inputUsername">Username</label>
                  <span class="text-danger">@error('username'){{ $message }} @enderror</span>
                </div>
  
                <div class="form-label-group">
                  <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
                  <label for="inputPassword">Password</label>
                  <span class="text-danger">@error('password'){{ $message }} @enderror</span>
                </div>
  
                <div class="custom-control custom-checkbox mb-3">
                  <input type="checkbox" class="custom-control-input" id="customCheck1">
                  <label class="custom-control-label" for="customCheck1">Remember password</label>
                </div>
                <button class="btn btn-lg btn-login btn-block " type="submit"></i>Log in Account</button>
                <p class ="flex-row my-2 text-sm-center">Dont have an account?</p>
                <a class="btn btn-lg btn-google btn-block  btn-register" type="button" href="{{ route('register') }}">Register Account</a>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
<html>
