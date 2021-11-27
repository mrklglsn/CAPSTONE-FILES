 <!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">

        <title>Assessment | English</title>
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
    </head>
    <body>
        <nav class="mb-1 navbar navbar-expand-lg text-white-50 nav-menu">
            <a class="btn" onclick="history.back(-1)"><i class="fa fa-arrow-left fa-2x"></i></a>
            <button class="navbar-toggler navbar-dark" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-555"
                aria-controls="navbarSupportedContent-555" aria-expanded="false" aria-label="Toggle navigation">
            </button>
            <ul class="navbar-nav ml-auto nav-flex-icons nav-menu">
                <a class="navbar-brand" href="addStudent.html"><img src="{{ url('public/frontend/images/user1.png') }}" width="50px"></a>
            </ul>
        </nav>

        <div class="container-fluid">  
            <audio id="myAudio">
                <source src="{{ url('public/frontend/Tutorial/wrong.mp3') }}" type="audio/mpeg">
            </audio>
            <audio loop id="bgMusic">
                <source src="{{ url('public/frontend/Tutorial/bgmusic.mp3') }}" type="audio/mpeg">
            </audio>
            <audio id="myAudioYey">
                <source src="{{ url('public/frontend/Tutorial/Yey.mp3') }}" type="audio/mpeg">
            </audio>
            <audio id="Finish">
                <source src="{{ url('public/frontend/Tutorial/finish.mp3') }}" type="audio/mpeg">
            </audio>
            <input type="text" value="{{ session('LoggedStudent') }}" hidden>
            <div class="wrapper questions" id="question1">
                <div class="equation">
                    <div class="col">
                        <div class="row" id="question-container">
                        </div>
                        <div class="row" id="image-container">
                        </div>
                    </div> 
                </div>
                <div class="answer-options">
                    <div class="options" id="options1" style="background-color: #FE4A49; position: relative;">
                        
                    </div>
                    <div class="options" id="options2" style="background-color: #2AB7CA; position: relative;">
                    
                    </div>
                    <div class="options" id="options3" style="background-color: #FED766; position: relative;">
                       
                    </div>
                </div>
            </div>
            <div id ="idle">
                <img src="{{ url('public/frontend/images/idle-crossed.gif') }}" id="idleGif" class="fix-adaptive" style="display: none;">
            </div>
            <div id ="correct">
                <img src="{{ url('public/frontend/images/correct_answer.gif') }}" id="correctGif" class="fix-adaptive" style="display: none;">
            </div>
            <div id="wrong">
                <img src="{{ url('public/frontend/images/wrong-answer.gif') }}" id="wrongGif" class="fix-adaptive" style="display: none;">
            </div>
        </div>
        <br><br>
        <script src="{{ url('public/frontend/vendor/jquery/dist/jquery.min.js') }}"></script>
        <script src="{{ url('public/frontend/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            // Initialize new SpeechSynthesisUtterance object
            let speech = new SpeechSynthesisUtterance();
            let voices = [];
            voices = window.speechSynthesis.getVoices();
            // Set Speech Language
            speech.lang = "en";
            speech.rate = 1;
            speech.volume = 1;
            speech.pitch = 1;

            window.speechSynthesis.onvoiceschanged = () => {
                // Get List of Voices
                voices = window.speechSynthesis.getVoices();
                // Initially set the First Voice in the Array.
                speech.voice = voices[5];
            };
  
            $('body').on('click', '.playQuestion', function () {
                speech.text = $('.statement').text();
                window.speechSynthesis.cancel();
                window.speechSynthesis.speak(speech);
            });

            $('body').on('mouseenter', '#playQuestion', function () {
                playQuestion();
            });

            function playQuestion(){
                speech.text = $('.statement').text();
                window.speechSynthesis.cancel();
                window.speechSynthesis.speak(speech);
            }

            function playOption(num){
                speech.text = $('#option'+num).text();
                window.speechSynthesis.cancel();
                window.speechSynthesis.speak(speech);
            }
        </script>



        <script type="text/javascript">
            var question = {!! json_encode($questions->toArray(), JSON_HEX_TAG) !!};
            var assessment = {!! json_encode($quiz->toArray(), JSON_HEX_TAG) !!};
            var numOfQuestion = question.length;
            var wrong = document.getElementById("myAudio"); 
            var yey = document.getElementById("myAudioYey");
            var bgmusic = document.getElementById("bgMusic");
            var Finish = document.getElementById("Finish");
            var index = 0;
            var moveCount =0;
            $(function () {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                
                $(".howToPlay").modal('show');
                 
            });
            
            function clearFields(){
                $('#question-container').empty(); 
                $('#image-container').empty(); 
                $('#options1').empty(); 
                $('#options2').empty(); 
                $('#options3').empty(); 
            }
            function wrongAnswer(){
                wrong.play();
                $('#wrongGif').show(); 
                $('#idleGif').hide();
                $('#correctGif').hide();
                setTimeout(function(){ idleGif() }, 3000);
                speech.text = "It seems not the correct answer";
                window.speechSynthesis.cancel();
                window.speechSynthesis.speak(speech);
            }
            function correctAnswer(){
                $('#wrongGif').hide(); 
                $('#idleGif').hide();
                $('#correctGif').show();
            }
            function idleGif(){
                $('#wrongGif').hide(); 
                $('#idleGif').show();
                $('#correctGif').hide();
            }
            function nextQuestion(num) {  
                if(num < numOfQuestion){
                    clearFields();
                    $('#question-container').append('<h1 id="question'+num+'" class="mx-auto statement">'+question[num].question+
                                                '<a href="#" id="playQuestion" class="btn playQuestion"><i class="fa fa-volume-up fa-2x"></i></a></h1>');
                    $('#image-container').append('<img src="https://localhost/caipreschool/public/storage/images/'+question[num].question_image+'" class="image-size mx-auto">');
                    if(question[num].question_type == 1){
                        $('#options1').append('<h1 class="font-option" id="option1">'+question[num].choice1+'</h1><a href="#" id="playOption1" onmouseenter="playOption(1)" class="btn playOption optionAudio"><i class="fa fa-volume-up fa-2x"></i></a>');
                        $('#options2').append('<h1 class="font-option" id="option2">'+question[num].choice2+'</h1><a href="#" id="playOption2" onmouseenter="playOption(2)" class="btn playOption optionAudio"><i class="fa fa-volume-up fa-2x"></i></a>');
                        $('#options3').append('<h1 class="font-option" id="option3">'+question[num].choice3+'</h1><a href="#" id="playOption3" onmouseenter="playOption(3)" class="btn playOption optionAudio"><i class="fa fa-volume-up fa-2x"></i></a>');
                    }
                    else{
                        $('#options1').append('<img src="https://localhost/caipreschool/public/storage/images/'+question[num].choice1+'" id="option1" class="image-option-size mx-auto">');
                        $('#options2').append('<img src="https://localhost/caipreschool/public/storage/images/'+question[num].choice2+'" id="option2" class="image-option-size mx-auto">');
                        $('#options3').append('<img src="https://localhost/caipreschool/public/storage/images/'+question[num].choice3+'" id="option3" class="image-option-size mx-auto">');
                    } 
                    playQuestion();
                    addStyle();
                }
                else{
                    alert("This is last question");
                }
            };
            
            function getAnswerLocation(){
                if(question[index-1].question_type == 1){
                    return question[index-1].answer_index;
                }
                else{
                    return question[index-1].answer_index - 3;
                } 
            }
            function addStyle(){
                $('.optionAudio').css({
                    "position": "absolute",
                    "color": "white",
                    "font-size": "1.1vw",
                    "bottom": "0",
                    "padding-top": "5px",
                    "right": "0"
                });
            }

            function checkAnswer(num){
                var answerLoc = getAnswerLocation();
                if(answerLoc == num){
                    let timerInterval
                    yey.play();
                    Swal.fire({
                        imageUrl: 'https://localhost/caipreschool/public/frontend/images/clap.gif',
                        imageHeight: 400,
                        showCancelButton: false,
                        showConfirmButton: false,
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        timer: 2000,
                        didOpen: () => {
                            correctAnswer();
                        },
                        willClose: () => {
                            clearInterval(timerInterval)
                        }
                    }).then((result) => {
                        /* Read more about handling dismissals below */
                        if (result.dismiss === Swal.DismissReason.timer) {
                            console.log('I was closed by the timer')
                            if(index == numOfQuestion){
                                showEndGamePanel();
                            }
                            else{
                                nextQuestion(index);
                                index++;
                            } 
                            idleGif();
                            console.log("index: "+index+ "num:"+numOfQuestion);
                        }
                    })  
                    $(".swal2-modal").css('background-color', 'transparent');//Optional changes the color of the sweetalert 
                }
                else{        
                    wrongAnswer(); 
                } 
                moveCount++;
                console.log("Move: "+moveCount+" Perfect Move: "+numOfQuestion);
            }

            function showEndGamePanel(){
                var starsCount = 0;
                if(moveCount == numOfQuestion){
                    $("#starContainer").attr("src","https://localhost/caipreschool/public/frontend/images/3star.png");
                    starsCount = 3;
                }
                else if(moveCount > numOfQuestion && moveCount < numOfQuestion + 5){
                    $("#starContainer").attr("src","https://localhost/caipreschool/public/frontend/images/2star.png");
                    starsCount = 2;
                } 
                else{
                    $("#starContainer").attr("src","https://localhost/caipreschool/public/frontend/images/1star.png");
                    starsCount = 1;
                } 
                $("#modalEndGame").modal('toggle');
                bgmusic.pause();
                Finish.play();
                saveData(starsCount);
            }

            function saveData(starsCount){
                var data = { id : 0, assessment_id : assessment.id, stars_count : starsCount  };
                $.ajax({
                    data: data,
                    url: "{{ route('assessment_record.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        
                    },
                    error: function (data) {
                    
                    }
                });
            }

            $('body').on('click', '#option1', function () {
                checkAnswer(0);
            });
            $('body').on('click', '#option2', function () {
                checkAnswer(1);
            });
            $('body').on('click', '#option3', function () {
                checkAnswer(2);
            });

           
            $('body').on('click', '.start', function () {
                bgmusic.volume = 0.05;
                yey.volume = 0.1;
                bgmusic.play();
                idleGif();
                nextQuestion(index);
                index++;
            });
        </script>
    </body>
    <div class="modal fade endGame" id="modalEndGame" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md  modal-dialog-centered" role="document" >
            <div class="modal-content border-0" style="background-color: transparent;">
                <div class="modal-body mx-auto">
                    <img src="{{ url('public/frontend/images/3star.png') }}" id="starContainer" width="100%">
                    <img src="{{ url('public/frontend/images/MATH.png') }}" class="math-mascot" width="50%">
                    <a class="button-home p-2" href="{{ route("student/home", session()->get("LoggedStudent")) }}">
                        <img src="{{ url('public/frontend/images/home.png') }}" width="50%" class="btn">
                    </a>
                    <a class="button-next p-2" href="{{ route("student/home") }}">
                        <img src="{{ url('public/frontend/images/menu.png') }}" width="50%" class="btn">
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade howToPlay" id="modalDelete" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl  modal-dialog-centered" role="document" >
            <div class="modal-content border-0" style="background-color: transparent;">
                <div class="modal-body mx-auto">
                    <img src="{{ url('public/frontend/images/assessment_instruction.gif') }}" width="100%">
                    <a class="button-start start" href="#" data-dismiss="modal" aria-hidden="true">
                    <img src="{{ url('public/frontend/images/start_button.png') }}" width="50%" class="btn">
                    </a>
                </div>
            </div>
        </div>
    </div>
    
</html>