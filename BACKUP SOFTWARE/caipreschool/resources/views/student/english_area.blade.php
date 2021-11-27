<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
    
        <title>English Area</title>
        <meta content="" name="description">
        <meta content="" name="keywords">
    
        <!-- Favicons -->
        <link href="{{ url('public/frontend/images/favicon.png') }}" rel="icon">
        <link href="{{ url('public/frontend/images/apple-touch-icon.png') }}" rel="apple-touch-icon">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ url('public/frontend/css/parent.css') }}">
        <script src="{{ url('public/frontend/vendor/jquery/dist/jquery.min.js') }}"></script>
        <script src="{{ url('public/frontend/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    </head>
    <body>
        <nav class="mb-1 navbar navbar-expand-lg text-white-50 nav-menu">
            <a class="btn" onclick="history.back(-1)"><i class="fa fa-arrow-left fa-2x"></i></a>
            <button class="navbar-toggler navbar-dark" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-555"
                aria-controls="navbarSupportedContent-555" aria-expanded="false" aria-label="Toggle navigation">
            </button>
            <ul class="navbar-nav ml-auto nav-flex-icons nav-menu">
                <a class="navbar-brand" href="{{ route("parent/home") }}"><img src="{{ url('public/frontend/images/user1.png') }}" width="50px"></a>
            </ul>
        </nav>
        <div class ="container">
            <div id="div_ul">
                <ul class="nav nav-pills text-center" id="tabs" style="flex-wrap: nowrap;">
                    <li class=""><a data-toggle="pill" href="#home" class="">
                        <img src="{{ url('public/frontend/images/game_logo.png') }}" class="tabpane-size btn tabs "></a>
                        <h5 class="text-center">Games</h5>
                    </li>
                    <li><a data-toggle="pill" href="#menu1">
                        <img src="{{ url('public/frontend/images/quiz_logo.png') }}" class="tabpane-size btn tabs"></a>
                            <h5 class="text-center">Assessments</h5>
                    </li>
                    <li>
                        <a data-toggle="pill" href="#menu2"><img src="{{ url('public/frontend/images/videos_logo.png') }}" class="tabpane-size btn tabs"></a>
                        <h5 class="text-center">Videos</h5>
                    </li>
                    <li>
                        <a data-toggle="pill" href="#menu3"><img src="{{ url('public/frontend/images/books_logo.png') }}" class="tabpane-size btn tabs"></a>
                        <h5 class="text-center">Books</h5>
                    </li>
                </ul>
            </div>
            <div class="tab-content">
                <div id ="home" class=" tab-pane fade active show">
                    <div class="row pt-3 pl-3">
                        <h3 class="account-settings">English Activities</h3>
                    </div>
                    <hr class="hr-line">
                    <div class="row fluid text-center">
                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <a class="btn" href="{{ route('student/english_area/activity1') }}">
                                <img src="{{ url('public/frontend/images/game_logos/guess_the_letter.png') }}" class="card-img-top">
                                <h5 class="card-title text-center pt-1">Activity 1</h5>
                            </a>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <a class="btn" href="{{ route('student/english_area/activity2') }}">
                                <img src="{{ url('public/frontend/images/game_logos/match_the_letter_vowel.png') }}" class="card-img-top">
                                <h5 class="card-title text-center pt-1">Activity 2</h5>
                            </a>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <a class="btn" href="{{ route('student/english_area/activity3') }}">
                                <img src="{{ url('public/frontend/images/game_logos/guess_the_spelling.png') }}" 
                                lass="card-img-top">
                                <h5 class="card-title text-center pt-1 ">Activity 3</h5>
                            </a>
                        </div>
                    </div>
                </div>
                
                <div id ="menu1" class="tab-pane fade">
                    <div class="row pt-3 pl-3">
                        <h3 class="account-settings">English Assessments</h3>
                    </div>
                    <hr class="hr-line">
                    <div class="row fluid text-center">
                        @foreach ($quizzes as $quiz)
                            <div class="col-xs-12 col-sm-6 col-md-3">
                                <a class="btn" href="{{ route('student/english_area/assessment', $quiz->id) }}">
                                    <img class="card-img-top" src="{{ url('public/frontend/images/game_logos/assessment.png') }}">
                                    <h5 class="card-title text-center pt-1">{{ $quiz->title }}</h5>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div id ="menu2" class="tab-pane fade">
                    <div class="row pt-3 pl-3">
                        
                        <div class="container">
                            <div class="row pt-5 pl-3">
                            <h3 class="account-settings">Letters</h3>
                            </div>
                            <hr class="hr-line">
                            <div class ="row">
                                <div class="col">
                                    <div class="row">
                                        <div class="col-sm p-2">
                                            <a class="" href="studentSide.html">
                                                <img src="https://cdn.shopify.com/s/files/1/2018/8867/files/play-button.png?422609932170209736" class="card-img-top card-image-fix">
                                            </a>
                                                <div class="card-body">
                                                    <h5 class="card-title text-center">Video Title 1</h5>
                                                </div>
                                        </div>
                                        <div class="col-sm p-2">
                                            <a class="" href="studentSide.html">
                                                <img src="https://cdn.shopify.com/s/files/1/2018/8867/files/play-button.png?422609932170209736" class="card-img-top card-image-fix">
                                            </a>
                                                <div class="card-body">
                                                    <h5 class="card-title text-center">Video Title 2</h5>
                                                </div>
                                        </div>
                                        <div class="col-sm p-2">
                                            <a class="" href="studentSide.html">
                                                <img src="https://cdn.shopify.com/s/files/1/2018/8867/files/play-button.png?422609932170209736" class="card-img-top card-image-fix">
                                            </a>
                                                <div class="card-body">
                                                    <h5 class="card-title text-center">Video Title 3</h5>
                                                </div>
                                        </div>
                                        <div class="col-sm p-2">
                                          <a class="" href="studentSide.html">
                                              <img src="https://cdn.shopify.com/s/files/1/2018/8867/files/play-button.png?422609932170209736" class="card-img-top card-image-fix">
                                          </a>
                                              <div class="card-body">
                                                  <h5 class="card-title text-center">Video Title 3</h5>
                                              </div>
                                      </div>
                                      <div class="col-sm p-2">
                                        <a class="" href="studentSide.html">
                                            <img src="https://cdn.shopify.com/s/files/1/2018/8867/files/play-button.png?422609932170209736" class="card-img-top card-image-fix">
                                        </a>
                                            <div class="card-body">
                                                <h5 class="card-title text-center">Video Title 3</h5>
                                            </div>
                                    </div>
                                    <div class="col-sm p-2">
                                            <a class="" href="studentSide.html">
                                                <img src="https://cdn.shopify.com/s/files/1/2018/8867/files/play-button.png?422609932170209736" class="card-img-top card-image-fix">
                                            </a>
                                                <div class="card-body">
                                                    <h5 class="card-title text-center">Video Title 3</h5>
                                                </div>
                                        </div>
                                        <div class="w-100"></div>
                                      </div>
                                      <div class="row pl-3">
                                        <h3 class="account-settings">Numbers</h3>
                                      </div>
                                      <hr class="hr-line">
                                      <div class ="row">
                                        <div class="col-sm p-2">
                                            <a class="" href="studentSide.html">
                                                <img src="https://cdn.shopify.com/s/files/1/2018/8867/files/play-button.png?422609932170209736" class="card-img-top card-image-fix">
                                            </a>
                                                <div class="card-body">
                                                    <h5 class="card-title text-center">Video Title 1</h5>
                                                </div>
                                        </div>
                                        <div class="col-sm p-2">
                                          <a class="" href="studentSide.html">
                                              <img src="https://cdn.shopify.com/s/files/1/2018/8867/files/play-button.png?422609932170209736" class="card-img-top card-image-fix">
                                          </a>
                                              <div class="card-body">
                                                  <h5 class="card-title text-center">Video Title 1</h5>
                                              </div>
                                      </div>
                                      <div class="col-sm p-2">
                                        <a class="" href="studentSide.html">
                                            <img src="https://cdn.shopify.com/s/files/1/2018/8867/files/play-button.png?422609932170209736" class="card-img-top card-image-fix">
                                        </a>
                                            <div class="card-body">
                                                <h5 class="card-title text-center">Video Title 1</h5>
                                            </div>
                                    </div>
                                    <div class="col-sm p-2">
                                      <a class="" href="studentSide.html">
                                          <img src="https://cdn.shopify.com/s/files/1/2018/8867/files/play-button.png?422609932170209736" class="card-img-top card-image-fix">
                                      </a>
                                          <div class="card-body">
                                              <h5 class="card-title text-center">Video Title 1</h5>
                                          </div>
                                  </div>
                                  <div class="col-sm p-2">
                                    <a class="" href="studentSide.html">
                                        <img src="https://cdn.shopify.com/s/files/1/2018/8867/files/play-button.png?422609932170209736" class="card-img-top card-image-fix">
                                    </a>
                                        <div class="card-body">
                                            <h5 class="card-title text-center">Video Title 1</h5>
                                        </div>
                                </div>
                                <div class="col-sm p-2">
                                  <a class="" href="studentSide.html">
                                      <img src="https://cdn.shopify.com/s/files/1/2018/8867/files/play-button.png?422609932170209736" class="card-img-top card-image-fix">
                                  </a>
                                      <div class="card-body">
                                          <h5 class="card-title text-center">Video Title 1</h5>
                                      </div>
                              </div>
                                    </div>
                                </div>
                            </div>
                         </div>
                    </div>
                </div>

                <div id ="menu3" class="tab-pane fade">
                    <div class="row pt-3 pl-3">
                        <h3 class="account-settings">Books</h3>
                </div>
                <hr class="hr-line">
            </div>
        </div>
    </body>
</html>