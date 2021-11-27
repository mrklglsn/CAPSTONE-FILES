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
                <li class="breadcrumb-item active">Subject Management</li>
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
                    <input class="form-control" placeholder="Search Subjects" id="searchBar" type="text">
                  </div>
                </div>
                  <a href="#!" class="btn btn-success" id="addSubject" data-toggle="modal" data-target="#modalSubject"><i class="fa fa-plus mr-2"></i>Add Subject</a>
            </div>
          </div>

          <div id="messageArea"></div>

          <div class="table-responsive">
            <!-- Projects table -->
            <table class="table align-items-center table-flush" id="data-table-subjects">
              <thead class="thead-light">
                <tr>
                  <th scope="col">Subject ID</th>
                  <th scope="col">Subject Name</th>
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
  @include('layouts.footers.footer')
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
    
    var table = $('#data-table-subjects').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('subjects.index') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'subject_name', name: 'subject_name'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    $('#submitSubject').click(function (e) {
      e.preventDefault();
      $(this).html('Save');
  
      $.ajax({
        data: $('#subjectForm').serialize(),
        url: "{{ route('subjects.store') }}",
        type: "POST",
        dataType: 'json',
        success: function (data) {
            var successHtml = '<div class="alert alert-danger">'+data.success+'</div>';
            $('#messageArea').html(successHtml);
            $('#subjectForm').trigger("reset");
            $('#modalSubject').modal('toggle');
            table.draw();
        
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

    $('body').on('click', '.editSubject', function () {
        var subject_id = $(this).data('id');
        $('#addModalLabel').text("Edit Subject");
        $.get("{{ route('subjects.index') }}" +'/' + subject_id, function (data) {
            $('#subject_id').val(data.id);
            $('#subject_name').val(data.subject_name);
        })
    });

    $('body').on('click', '.deleteSubject', function () {
        var subject_id = $(this).data('id');
        $('#btnConfirmRecover').css("display", "none");
        $('#btnConfirmDelete').css("display", "block");
        $('#actionModalLabel').text("Delete Subject");
        $.get("{{ route('subjects.index') }}" +'/' + subject_id, function (data) {
            var message = 'Are you sure you want to delete <strong><span>'+data.subject_name+'</span></strong> subject';
            $('#subject_id_action').val(data.id);
            $('#subject_name').val(data.subject_name);
            $('#actionMessage').html(message);
        })
    });

    $('body').on('click', '.recoverSubject', function () {
        var subject_id = $(this).data('id');
        $('#btnConfirmRecover').css("display", "block");
        $('#btnConfirmDelete').css("display", "none");
        $('#actionModalLabel').text("Recover Subject");
        $.get("{{ route('subjects.index') }}" +'/' + subject_id, function (data) {
            var message = 'Are you sure you want to recover <strong><span>'+data.subject_name+'</span></strong> subject';
            $('#subject_id_action').val(data.id);
            $('#subject_name').val(data.subject_name);
            $('#actionMessage').html(message);
        })
    });

    $('body').on('click', '#btnConfirmDelete', function () {
      var subject_id = $('#subject_id_action').val();

      $.ajax({
          type: "DELETE",
          url: "{{ route('subjects.store') }}"+'/'+subject_id,
          success: function (data) {
              $('#modalActionModal').modal('toggle');
              table.draw();
              Toastify({
                text: data.success ,
                duration: 3000
              }).showToast();
          },
          error: function (data) {
              console.log('Error:', data);
          }
      });
    });

    $('body').on('click', '#btnConfirmRecover', function () {
        var subject_id = $('#subject_id_action').val();

        $.ajax({
            url: "{{ route('subjects.recover')}}/"+subject_id,
            success: function (data) {
                $('#modalRecoverParent').hide();
                table.draw();
                Toastify({
                  text: data.success ,
                  duration: 3000
                }).showToast();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
      });

    $('#searchBar').on('keyup change', function(){
        table.search($(this).val()).draw();
    })

    $('#addSubject').on('click', function(){
      $('#addModalLabel').text("Add Subject");
    })

    $(".dataTables_filter").hide();

  });

</script>

@endsection
<div class="modal fade" id="modalSubject" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addModalLabel">Add Subject</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form role="form" id="subjectForm" >
          <div class="form-group mb-3">
            <p class="text-danger" id="errorMessage"></p>
            <p class="form-text small">Subject</p>
              <div class="form-label-group">
                <input class="form-control" id="subject_id" name="subject_id" hidden>
                <input class="form-control" placeholder="Enter Subject" id="subject_name" name="subject_name" required>
              </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success" id="submitSubject">Submit</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalActionSubject" tabindex="-1" role="dialog" aria-labelledby="actionModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="actionModalLabel">Recover Subject</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form role="form" id="recoverForm" name="modalForm">
          <input class="form-control" id="subject_id_action" name="subject_id_action" type="text" hidden>
          <h5 id="actionMessage"></h5>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalActionSubject" id="btnConfirmDelete" >Yes</button>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalActionSubject" id="btnConfirmRecover" style="display: none">Yes</button>
      </div>
    </div>
  </div>
</div>

