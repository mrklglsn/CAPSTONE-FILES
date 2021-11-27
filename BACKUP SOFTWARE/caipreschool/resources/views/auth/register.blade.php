<html>
    <head>
        <title>Register account</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{ url('public/frontend/images/favicon.png') }}" rel="icon">
        <link href="{{ url('public/frontend/images/apple-touch-icon.png') }}" rel="apple-touch-icon">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ url('public/frontend/css/style.css') }}">
        <link rel="stylesheet" href="{{ url('public/css/sweetalert2.min.css') }}" type="text/css">
        
    </head>

    <body>
        <div class="container">
          <div class="row">
            <div class="col-lg-10 col-xl-9 mx-auto">
              <div class="card card-signin flex-row my-5">
                <div class="card-img-left d-none d-md-flex">
                   <!-- Background image for card set in CSS! -->
                </div>
                <div class="card-body">
                  <h5 class="card-title text-center">Register</h5>
                  <form class="form-signin" action="{{ route('auth.save') }}" method="POST">
                    @if (Session::get('success'))
                      <div class="alert alert-success">
                        {{ Session::get('success') }}
                      </div>
                    @endif
                    @if (Session::get('fail'))
                      <div class="alert alert-danger">
                        {{ Session::get('fail') }}
                      </div>
                    @endif
                    @csrf
                    <div class="form-label-group">
                      <input type="text" id="inputUserame" name="username" class="form-control" placeholder="Username" value="{{ old('username') }}" required autofocus>
                      <label for="inputUserame">Username</label>
                      <span class="text-danger">@error('username'){{ $message }} @enderror</span>
                    </div>
                    <div class="form-label-group">
                      <input type="text" id="inputFullname" name="full_name" class="form-control" placeholder="Full name" value="{{ old('full_name') }}" required>
                      <label for="inputFullname">Full Name</label>
                      <span class="text-danger">@error('full_name'){{ $message }} @enderror</span>
                    </div>
                    <div class="form-label-group">
                      <input type="text" id="inputEmail" name="email" class="form-control" placeholder="Email address" value="{{ old('email') }}" required>
                      <label for="inputEmail">Email address</label>
                      <span class="text-danger">@error('email'){{ $message }} @enderror</span>
                    </div>
                    <div class="form-label-group">
                      <input type="text" id="inputContactNumber" name="contact_number" class="form-control" placeholder="Contact number" value="{{ old('contact_number') }}" required>
                      <label for="inputContactNumber">Contact Number</label>
                      <span class="text-danger">@error('contact_number'){{ $message }} @enderror</span>
                    </div>
                    <hr>
      
                    <div class="form-label-group">
                      <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
                      <label for="inputPassword">Password</label>
                    </div>
                    
                    <div class="form-label-group">
                      <input type="password" id="inputConfirmPassword" name="password_confirmation" class="form-control" placeholder="Re-enter Password" required>
                      <label for="inputConfirmPassword">Confirm password</label>
                      <span class="text-danger">@error('password'){{ $message }} @enderror</span>
                    </div>
                    
                    <button type="submit" class="btn btn-lg btn-register btn-block">Register account</button>
                    <p class ="flex-row my-2 text-sm-center">Already have an account?</p>
                    <a class="btn btn-lg btn-login btn-block" type="submit" href="{{ route('login') }}">Login your account</a>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="{{ url('public/frontend/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ url('public/js/sweetalert2.min.js') }}"></script>
        @if(session()->has('success'))
          <script>
              let timerInterval;
              Swal.fire({
                icon: 'success',
                title: '{{ session()->get("success") }}',
                html: 'You will be redirected to login page in 2 seconds',
                timer: 2000,
                timerProgressBar: true,
                didOpen: () => {
                  Swal.showLoading()
                },
                willClose: () => {
                  clearInterval(timerInterval)
                }
              }).then((result) => {
                /* Read more about handling dismissals below */
                if (result.dismiss === Swal.DismissReason.timer) {
                  console.log('I was closed by the timer');
                  window.location.href = "{{ route('login')}}";  
                }
              })
          </script>
        @endif 
      </body>
</html>
    