@extends('layouts.app')

@section('content')
    <!-- Header -->
    <div class="header bg-gradient-green pt-2">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row py-2">
                    <div class="col">
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-1">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item active">{{ $quiz->title }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <!-- Card stats -->
                <div class="row">

                </div>
            </div>
        </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid pt-3">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Questions
                        
                    </div>
                    <div class="card-body">
                        <div class="container-fluid w-75">
                            <ul class="list-group">
                                @if ($questions->isEmpty())
                                    <li class="list-group-item">
                                        <div class="row">
                                            No questions founds
                                        </div>
                                    </li>
                                @endif
                                @foreach ($questions as $question)
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <p>{{ $question->question}}</p>
                                        </div>
                                        <div class="col-md-2">
                                            <button class="btn btn-sm btn-outline-primary edit_question" data-id="{{ $question->question_id }}" data-toggle="modal" data-target="#modalAddQuestions"  type="button"><i class="fa fa-edit"></i></button>
                                            <button class="btn btn-sm btn-outline-danger remove_question" data-id="{{ $question->question_id }}" type="button"><i class="fa fa-trash"></i></button>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                                <li class="list-group-item">    
                                    <div class="d-flex justify-content-center">
                                        <button class="btn btn-success add question w-50 add_question" data-toggle="modal" data-target="#modalAddQuestions" type="button"><i class="fa fa-plus"></i></button>
                                        
                                        <a class="btn btn-primary add question w-20 pl-2" href="{{ route('dashboard.manageassessments', session()->get('ViewSubject')) }}">
                                            <i class="fa fa-check pr-2"></i>Done
                                          </a>
                                    </div>    
                                </li>
                            </ul>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footers.footer')
    <div class="modal fade" id="modalAddQuestions" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="questionModalLabel">Add Question</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <form role="form" id="questionForm" enctype="multipart/form-data">
                    <div class="form-group mb-3">
                        <p class="form-text small">Question</p>
                        <div class="input-group input-group-merge input-group-alternative">
                            <input class="form-control" name="question_id" id="question_id" hidden>
                            <input class="form-control" name="question" id="question" placeholder="Enter questions">
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <p class="form-text small">Image</p>
                        <div class="input-group input-group-merge input-group-alternative">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="photo" id="photo" accept="image/*">
                                <label class="custom-file-label" id="photoLabel0" for="photo">Choose image file only</label>
                            </div>
                        </div>  
                        <small><span class="fa fa-info"></span> Upload an image illustration base on the question above</small>
                    </div>
                    <div class="form-group mb-3">
                        <p class="form-text small">Type of Choices</p>
                        <div class="btn-group btn-group-toggle container" data-toggle="buttons">
                            <label class="btn btn-secondary active col px-md-10" id="labelType1">
                                <input type="radio" class="" name="type" id="type1" value="1" autocomplete="off" checked> Text
                            </label>
                            <label class="btn btn-secondary col px-md-10" id="labelType2">
                                <input type="radio" name="type" id="type2" value = "2" autocomplete="off"> Image
                            </label>
                        </div>
                    </div>
                    <div class="form-group mb-3 choice" id="divChoice1">
                        <p class="form-text small">Choice 1</p>
                        <div class="input-group input-group-merge input-group-alternative">
                            <input class="form-control" name="choice1" id="choice1" placeholder="Enter choice">
                        </div>
                        <input type="radio" name="answer" value="0" autocomplete="off"> Correct Answer
                        <p class="form-text small">Choice 2</p>
                        <div class="input-group input-group-merge input-group-alternative">
                            <input class="form-control" name="choice2" id="choice2" placeholder="Enter choice">
                        </div>
                        <input type="radio" name="answer" value="1" autocomplete="off"> Correct Answer
                        <p class="form-text small">Choice 3</p>
                        <div class="input-group input-group-merge input-group-alternative">
                            <input class="form-control" name="choice3" id="choice3" placeholder="Enter choice"> 
                        </div>
                        <input type="radio" name="answer" value="2" autocomplete="off"> Correct Answer
                    </div>
                    <div class="form-group mb-3 choice" id="divChoice2">
                        <p class="form-text small">Choice 1</p>
                        <div class="input-group input-group-merge input-group-alternative">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="choice4" id="choice4" accept="image/*">
                                <label class="custom-file-label" id="photoLabel1" for="choice4">Choose image file only</label>
                            </div>
                        </div>  
                        <input type="radio" name="answer" value="3" autocomplete="off"> Correct Answer
                        <p class="form-text small">Choice 2</p>
                        <div class="input-group input-group-merge input-group-alternative">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="choice5" id="choice5" accept="image/*">
                                <label class="custom-file-label" id="photoLabel2" for="choice5">Choose image file only</label>
                            </div>
                        </div>  
                        <input type="radio" name="answer" value="4" autocomplete="off"> Correct Answer
                        <p class="form-text small">Choice 3</p>
                        <div class="input-group input-group-merge input-group-alternative">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="choice6" id="choice6" accept="image/*">
                                <label class="custom-file-label" id="photoLabel3" for="choice6">Choose image file only</label>
                            </div>
                        </div>  
                        <input type="radio" name="answer" value="5" autocomplete="off"> Correct Answer
                    </div> 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" id="submitAssessment">Save</button>
                </form>
                </div>
            </div>
        </div>
    </div>
    
@endsection
@section('ajaxScript')
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#divChoice2").hide();
        
        $("input[name='type']").click(function() {
            var test = $(this).val();
            switchChoiceType(test);
        });

        function switchChoiceType(num){
            $("div.choice").hide();
            $("#divChoice" + num).show();

            if(num == 1){
                $("#labelType1").addClass('active focus');
                $("#labelType2").removeClass('active focus');
            }
            else if(num == 2){
                $("#labelType1").removeClass('active focus');
                $("#labelType2").addClass('active focus');
            }
        }

        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            console.log(fileName);
        });

        $('#questionForm').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $('#questionForm').modal('toggle');
            $.ajax({
                type:'POST',
                url: "{{ route('questions.store') }}",
                data: formData,
                contentType: false,
                processData: false,
                success: (response) => {
                    Swal.fire(
                        'Success!',
                        response.success,
                        'success'
                    ).then(function() {
                        location.reload();
                    });
                },
                error: function(response){
                console.log(response);
                    $('#image-input-error').text(response.responseJSON.errors.file);
                }
            });
        });

        function formReset(){ 
            $('#questionForm').trigger("reset");
            switchChoiceType(1);
            for (let index = 0; index < 4; index++) {
                $('#photoLabel'+index+'').text("Choose image file only");
            }
        }

        
        $('body').on('click', '.add_question', function () {
            $('#questionModalLabel').text("Add Question");
            formReset(); 
        });

        $('body').on('click', '.edit_question', function () {
            var question_id = $(this).data('id');
            formReset();
            $('#questionModalLabel').text("Edit Question");
            $.get("{{ route('questions.index') }}" +'/' + question_id, function (data) {
                $('#question_id').val(data.questions_id_num);
                $('#question').val(data.question);
                $('#photoLabel0').text(data.question_image);
                if(data.question_type == 1){
                    switchChoiceType(data.question_type);
                    $('#choice1').val(data.choice1);
                    $('#choice2').val(data.choice2);
                    $('#choice3').val(data.choice3);
                    $("input[name='answer']").val([data.answer_index+""]);
                }
                else if(data.question_type == 2){ 
                    
                    switchChoiceType(data.question_type);
                    $('#photoLabel1').text(data.choice1);
                    $('#photoLabel2').text(data.choice2);
                    $('#photoLabel3').text(data.choice3);
                    $("input[name='answer']").val([data.answer_index +""]);
                }
                console.log($('#question_id').val() + "-question_id");
            })
        });

        $('body').on('click', '.remove_question', function () {
            var question_id = $(this).data('id');
            
            Swal.fire({
                title: 'Are you sure?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "DELETE",
                        url: "{{ route('questions.store') }}"+'/'+question_id,
                        success: function (data) {
                            Swal.fire(
                            'Deleted!',
                            'Quiz has been deleted.',
                            'success'
                            ).then((result) => {
                                if (result.isConfirmed) {
                                    location.reload();
                                }
                            })
                            
                        },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });
                }
            })
        });

    });
</script>
@endsection


