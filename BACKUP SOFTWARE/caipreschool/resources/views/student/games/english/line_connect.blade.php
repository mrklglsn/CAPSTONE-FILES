<!DOCTYPE html>
<html lang="en-us">
  <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
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
    <link rel="stylesheet" href="{{ url('public/storage/games/English/VowelsMatching/assets/css/reset.css') }}">
    <link rel="stylesheet" href="{{ url('public/storage/games/English/VowelsMatching/assets/css/style.css') }}">

    <title>English | Activity 3</title>
  </head>
  <body>
    <nav class="mb-1 navbar navbar-expand-lg text-white-50 nav-menu">
      <a class="btn" onclick="history.back(-1)"><i class="fa fa-arrow-left fa-2x"></i></a>

      <button class="navbar-toggler navbar-dark" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-555"
        aria-controls="navbarSupportedContent-555" aria-expanded="false" aria-label="Toggle navigation">

      </button>
      <ul class="navbar-nav ml-auto nav-flex-icons nav-menu">
        <a class="navbar-brand" href="{{ route("parent/home") }}"><img src="{{ url('public/frontend/images/user1.png') }}" width="50px"></a>
        <input type="text" id="loggedStudent" value="{{ session()->get('LoggedStudent') }}" hidden>
      </ul>
    </nav>
    <div class="container">
      <div class="row pt-3 pl-3">
        <h3 class="account-settings">Match the big letter to the small letter (vowels)</h3>
        <button type="button" class="btn btn-primary btn-sm ml-auto mr-3" onclick="myGameInstance.SetFullscreen(1)">
          <i class="fa fa-expand-arrows-alt fa-2x"></i>
        </button>
      </div>
      <hr class="hr-line">
      <div class="webgl-wrapper">
        <div class="aspect"></div>
        <div class="webgl-content">
          <div id="unityContainer">
            <canvas id="unity-canvas" style="background: #231F20"></canvas> 
          </div>
        </div>
      </div> 
    </div>

    <!-- LINE CONNECT -->
    <div class="modal fade endGame" id="lineConnect" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"  data-backdrop="static" aria-hidden="true" aria-hidden="true">
      <div class="modal-dialog modal-xl  modal-dialog-centered" role="document" >
        <div class="modal-content border-0" style="background-color: transparent;">
          <div class="modal-body mx-auto" style="position: relative">
            <h4 class="tutorial-text text-white">Drag the big letter to small letter
              <a href="#" class="btn text-white"><i class="fa fa-volume-up"></i></a>
            </h4>
            <img src="{{ url('public/frontend/images/Line_Connect.gif') }}" width="100%" >
            <a class="button-start" href="#" data-dismiss="modal" aria-hidden="true" style="display: none">
              <img src="{{ url('public/frontend/images/start_button.gif') }}" width="50%" class="btn">
            </a>
          </div>
        </div>
      </div>
    </div>
    
    <script src="{{ url('public/storage/games/English/VowelsMatching/MyLoader.js') }}"></script>
    <script>
      var buildUrl = "../../../public/storage/games/English/VowelsMatching/Build";
      var studentId =  parseInt($('#loggedStudent').val());
      createUnityInstance(document.querySelector("#unity-canvas"), {
        dataUrl: buildUrl + "/VowelsMatching.data",
        frameworkUrl: buildUrl + "/VowelsMatching.framework.js",
        codeUrl: buildUrl + "/VowelsMatching.wasm",
        streamingAssetsUrl: "StreamingAssets",
        companyName: "DefaultCompany",
        productName: "Trace Project",
        productVersion: "1.0",
      }).then((unityInstance) => {
        myGameInstance = unityInstance;
        myGameInstance.SendMessage('StudentId', 'setStudentId', studentId);
      });
    </script>

    <!-- check for F key press to toggle full screen -->
    <script>
      var isFullscreen = false;
      $(function () { 
        $('#lineConnect').modal("show");
        setTimeout(function(){ 
          $('.button-start').show();
          console.log("ok");
        }, 3000);
      });
      $('body').on('click', '.button-start', function () {
        myGameInstance.SetFullscreen(1);
      });
      document.addEventListener('keydown', function(event) {
          if (event.which === 70) {
              if (!isFullscreen) {
                myGameInstance.SetFullscreen(1);
              } else {
                myGameInstance.SetFullscreen(0);
              }
              isFullscreen = !isFullscreen;
          }
      });
    </script>
  </body>
</html>
