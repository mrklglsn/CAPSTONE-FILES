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
                            <li class="breadcrumb-item active">Assessments</li>
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
                    <div class="card-header border-0 bg-header">
                        <div class="row align-items-center">
                        <div class="col">
                            
                        </div>
                        <div class="form-group mb-0 rounded-circle pr-3 navbar-search-light navbar-search">
                            <div class="input-group input-group-alternative input-group-merge">
                                <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                                </div>
                                <input class="form-control" placeholder="Search" id="searchBar" type="text">
                            </div>
                            </div>
                            <a href="#!" class="btn btn-success" id="addAssessment" data-toggle="modal" data-target="#modalAssessment"><i class="fa fa-plus mr-2"></i>Add Assessment</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush wrap" id="data-table-assessment">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Subject</th>
                                    <th scope="col">No. of Questions</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                        <tbody>
                            
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footers.footer')
    <div class="modal fade" id="modalAssessment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Assessment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <form role="form" id="assessmentForm">
                    <div class="form-group mb-3">
                        <p class="form-text small">Title</p>
                        <div class="input-group input-group-merge input-group-alternative">
                            <input class="form-control" name="quiz_id" id="quiz_id">
                            <input class="form-control" name="title" id="title" placeholder="Enter assessment title">
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <p class="form-text small">Subject</p>
                        <div class="input-group input-group-merge input-group-alternative">
                            <select name="subject" id="subject" class="form-control">
                              <option value ="Math">Math</option>
                              <option value ="Science">Science</option>
                              <option value ="English">English</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="submitAssessment">Save</button>
                </div>
            </div>
        </div>
    </div>
  @endsection
  
  @section('ajaxScript')
  <script type="text/javascript">
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
    });
    
    var table = $('#data-table-assessment').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('assessments.index') }}",
        columns: [
            {data: 'assessment_id', name: 'assessment_id'},
            {data: 'title', name: 'title'},
            {data: 'subject', name: 'subject'},
            {data: 'numOfQuestion', name: 'numOfQuestion'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    $('#addAssessment').click(function (e) {
        $('#exampleModalLabel').text("Add Assessment");
        $('#assessmentForm').trigger("reset");
    });

    $('#submitAssessment').click(function (e) {
        e.preventDefault();
        $.ajax({
            data: $('#assessmentForm').serialize(),
            url: "{{ route('assessments.store') }}",
            type: "POST",
            dataType: 'json',
            success: function (data) {  
                $('#assessmentForm').trigger("reset");
                $('#modalAssessment').modal('toggle');
                table.draw();
                Toastify({
                    text: data.success ,
                    duration: 3000
                }).showToast();
            },
            error: function (data) {
                if (data.status == 422) { // when status code is 422, it's a validation issue
                    console.log(data.responseJSON);
                    // display errors on each form field
                    $.each(data.responseJSON.errors, function (i, error) {
                        var el = $(document).find('[name="'+i+'"]');
                        $('#errorMessage').text(error[0]);
                    });
                }
            }
        });
    });

    $('body').on('click', '.editAssessment', function () {
        var quiz_id = $(this).data('id');
        $('#questionForm').trigger("reset");
        $('#exampleModalLabel').text("Edit Assessment");
        $.get("{{ route('assessments.index') }}" +'/' + quiz_id, function (data) {
            $('#quiz_id').val(data.id);
            $('#title').val(data.title);
            $('#subject').val(data.subject);
        })
    });

    $('body').on('click', '.deleteAssessment', function () {
        var quiz_id = $(this).data('id');
        
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
                    url: "{{ route('assessments.store') }}"+'/'+quiz_id,
                    success: function (data) {
                        Swal.fire(
                        'Deleted!',
                        'Quiz has been deleted.',
                        'success'
                        );
                        table.draw();
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
                
            }
        })
    });

    $('body').on('click', '.deleteAssessment', function () {
        var quiz_id = $(this).data('id');
        
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
                    url: "{{ route('assessments.store') }}"+'/'+quiz_id,
                    success: function (data) {
                        Swal.fire(
                        'Deleted!',
                        'Quiz has been deleted.',
                        'success'
                        );
                        table.draw();
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
                
            }
        })
    });

    $('body').on('click', '.recoverAssessment', function () {
        var quiz_id = $(this).data('id');
        Swal.fire({
            title: 'Are you sure?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, recover it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('assessments.recover')}}/"+quiz_id,
                    success: function (data) {
                        Swal.fire(
                        'Recovered!',
                        'Quiz has been recovered.',
                        'success'
                        );
                        table.draw();
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
                
            }
        })
    });

    // $('body').on('click', '.manageAssessment', function () {
    //     var quiz_id = $(this).data('id');
    //     $.ajax({
    //         url: "{{ route('assessments.manage')}}/"+quiz_id,
    //         success: function (data) {
               
    //         },
    //         error: function (data) {
    //             console.log('Error:', data);
    //         }
    //     });
    // });
    
    $('#searchBar').on('keyup change', function(){
        table.search($(this).val()).draw();
    })

    $(".dataTables_filter").hide();

});
</script>
@endsection