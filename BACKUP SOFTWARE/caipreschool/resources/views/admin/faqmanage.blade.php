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
                  <li class="breadcrumb-item active">FAQs Management</li>
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
                      <input class="form-control" placeholder="Search FAQs" id="searchBar" type="text">
                    </div>
                  </div>
                    <a href="#!" class="btn btn-success" data-toggle="modal" data-target="#modalFAQs"><i class="fa fa-plus mr-2"></i>Add FAQs</a>
              </div>
            </div>

            <div id="messageArea"></div>

            <div class="table-responsive">
              <!-- Projects table -->
              <table class="table align-items-center table-flush" id="data-table-faqs">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">FAQ ID</th>
                    <th scope="col">Question</th>
                    <th scope="col">Answer</th>
                    <th scope="col">Added By</th>
                    <th scope="col">Deleted At</th>
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
    
    var table = $('#data-table-faqs').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('faqs.index') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'faqs_question', name: 'faqs_question'},
            {data: 'faqs_answer', name: 'faqs_answer'},
            {data: 'full_name', name: 'added_by'},
            {data: 'faqs_deleted_at', name: 'faqs_deleted_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    $('#submitFaqs').click(function (e) {
      e.preventDefault();
      $(this).html('Save');
  
      $.ajax({
        data: $('#faqsForm').serialize(),
        url: "{{ route('faqs.store') }}",
        type: "POST",
        dataType: 'json',
        success: function (data) {
            var successHtml = '<div class="alert alert-danger">'+data.success+'</div>';
            $('#messageArea').html(successHtml);
            $('#faqsForm').trigger("reset");
            $('#modalFaqs').modal('toggle');
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

    $('body').on('click', '.editFaqs', function () {
        var faqs_id = $(this).data('id');
        $('#addModalLabel').text("Edit Faqs");
        $.get("{{ route('faqs.index') }}" +'/' + faqs_id, function (data) {
            $('#faqs_id').val(data.id);
            $('#faqs_question').val(data.faqs_question);
            $('#faqs_answer').val(data.faqs_answer);
        })
    });

    $('body').on('click', '.deleteFaqs', function () {
        var faqs_id = $(this).data('id');
        $('#btnConfirmRecover').css("display", "none");
        $('#btnConfirmDelete').css("display", "block");
        $('#actionModalLabel').text("Delete Faqs");
        $.get("{{ route('faqs.index') }}" +'/' + faqs_id, function (data) {
            var message = 'Are you sure you want to delete this faqs';
            $('#faqs_id_action').val(data.id);
            $('#actionMessage').html(message);
        })
    });

    $('body').on('click', '.recoverFaqs', function () {
        var faqs_id = $(this).data('id');
        $('#btnConfirmRecover').css("display", "block");
        $('#btnConfirmDelete').css("display", "none");
        $('#actionModalLabel').text("Recover Faqs");
        $.get("{{ route('faqs.index') }}" +'/' + faqs_id, function (data) {
            var message = 'Are you sure you want to recover this faqs';
            $('#faqs_id_action').val(data.id);
            $('#actionMessage').html(message);
        })
    });

    $('body').on('click', '#btnConfirmDelete', function () {
      var faqs_id = $('#faqs_id_action').val();

      $.ajax({
          type: "DELETE",
          url: "{{ route('faqs.store') }}"+'/'+faqs_id,
          success: function (data) {
              var successHtml = '<div class="alert alert-danger">'+data.success+'</div>';
              $('#messageArea').html(successHtml);
              $('#modalActionModal').modal('toggle');
              table.draw();
          },
          error: function (data) {
              console.log('Error:', data);
          }
      });
    });

    $('body').on('click', '#btnConfirmRecover', function () {
        var faqs_id = $('#faqs_id_action').val();

        $.ajax({
            url: "{{ route('faqs.recover')}}/"+faqs_id,
            success: function (data) {
                var successHtml = '<div class="alert alert-primary">'+data.success+'</div>';
                $('#messageArea').html(successHtml);
                $('#modalActionModal').modal('toggle');
                table.draw();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
      });

    $('#searchBar').on('keyup change', function(){
        table.search($(this).val()).draw();
      })

    $(".dataTables_filter").hide();

  });

</script>

@endsection

<div class="modal fade" id="modalFaqs" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Faqs</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form role="form" id="faqsForm" name="faqsForm">
          <p class="text-danger" id="errorMessage"></p>
          <div class="form-group mb-3">
            <p class="form-text small">Question</p>
              <div class="form-label-group">
                <input class="form-control" id="faqs_id" name="faqs_id" hidden>
                <input class="form-control" placeholder="Enter the question" id="faqs_question" name="faqs_question" required>
              </div>
          </div>
          <div class="form-group mb-3">
            <p class="form-text small">Answer</p>
              <div class="form-label-group">
                <textarea class="form-control" id="faqs_answer" name="faqs_answer" row="5" col="200" placeholder="Enter the answer"></textarea>
              </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success" id="submitFaqs">Submit</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalActionFaqs" tabindex="-1" role="dialog" aria-labelledby="actionModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="actionModalLabel">Recover Faqs</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form role="form" id="recoverForm" name="modalForm">
          <input class="form-control" id="faqs_id_action" name="faqs_id_action" type="text" hidden>
          <h5 id="actionMessage"></h5>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalActionFaqs" id="btnConfirmDelete" >Yes</button>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalActionFaqs" id="btnConfirmRecover" style="display: none">Yes</button>
      </div>
    </div>
  </div>
</div>