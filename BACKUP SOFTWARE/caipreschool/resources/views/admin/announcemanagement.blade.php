@extends('layouts.app')
<style>
  table { 
    table-layout: fixed;
    width: 100%
  }

  table td {
    max-width: 70px;
    text-overflow:ellipsis;
    white-space: normal;
    overflow: hidden;
}
</style>

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
                <li class="breadcrumb-item active">Announcement Management</li>
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
                    <input class="form-control" placeholder="Search Announcement" type="text">
                  </div>
                </div>
                  <a href="#!" class="btn btn-success" data-toggle="modal" data-target="#modalAnnouncement"><i class="fa fa-plus mr-2"></i>Add Announcement</a>
            </div>
          </div>
          <div class="table-responsive">
            <!-- Projects table -->
            <table class="table align-items-center table-flush wrap" id="data-table-announcement">
              <thead class="thead-light">
                <tr>
                  <th scope="col">Announcement ID</th>
                  <th scope="col">Header</th>
                  <th scope="col" id="statement">Statement</th>
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
  </div>
  @include('layouts.footers.footer')
  <div class="modal fade" id="modalAnnouncement" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Announcement</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form role="form" id="announcementForm" name="announcementForm">
            <p class="text-danger" id="errorMessage"></p>
            <div class="form-group mb-3">
              <p class="form-text small">Header</p>
                <div class="form-label-group">
                  <input class="form-control" id="announcement_id" name="announcement_id" hidden>
                  <input class="form-control" placeholder="Enter the header" id="announcement_header" name="announcement_header" required>
                </div>
            </div>
            <div class="form-group mb-3">
              <p class="form-text small">Answer</p>
                <div class="form-label-group">
                  <textarea class="form-control" id="announcement_statement" name="announcement_statement" row="10" col="200" placeholder="Enter the statement"></textarea>
                </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-success" id="submitAnnouncement">Submit</button>
        </div>
      </div>
    </div>
  </div>
  
  <div class="modal fade" id="modalActionAnnouncement" tabindex="-1" role="dialog" aria-labelledby="actionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="actionModalLabel">Recover Announcement</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form role="form" id="recoverForm" name="modalForm">
            <input class="form-control" id="announcement_id_action" name="announcement_id_action" type="text" hidden>
            <h5 id="actionMessage"></h5>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
          <button type="button" class="btn btn-success" data-dismiss="modal" id="btnConfirmDelete" >Yes</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal" id="btnConfirmRecover" style="display: none">Yes</button>
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
    
    var table = $('#data-table-announcement').DataTable({
        processing: true,
        serverSide: true,
        autoWidth: false,
        ajax: "{{ route('announcement.index') }}",
        columns: [
            {data: 'id', name: 'id', width: '120px'},
            {data: 'announcement_header', name: 'announcement_header', width: '300px'},
            {data: 'announcement_statement', name: 'announcement_statement', width: '300px'},
            {data: 'full_name', name: 'added_by', width: '150px'},
            {data: 'announcements_deleted_at', name: 'announcements_deleted_at', width: '100px'},
            {data: 'action', name: 'action', orderable: false, searchable: false, width: '200px'},
        ]
    });

   

    $('#submitAnnouncement').click(function (e) {
      e.preventDefault();
      $(this).html('Save');
  
      $.ajax({
        data: $('#announcementForm').serialize(),
        url: "{{ route('announcement.store') }}",
        type: "POST",
        dataType: 'json',
        success: function (data) {
            var successHtml = '<div class="alert alert-danger">'+data.success+'</div>';
            $('#messageArea').html(successHtml);
            $('#announcementForm').trigger("reset");
            $('#modalAnnouncement').modal('toggle');
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

    $('body').on('click', '.editAnnouncement', function () {
        var announcement_id = $(this).data('id');
        $('#addModalLabel').text("Edit Announcement");
        $.get("{{ route('announcement.index') }}" +'/' + announcement_id, function (data) {
            $('#announcement_id').val(data.id);
            $('#announcement_header').val(data.announcement_header);
            $('#announcement_statement').val(data.announcement_statement);
        })
    });
    
    $('body').on('click', '.deleteAnnouncement', function () {
        var announcement_id = $(this).data('id');
        $('#btnConfirmRecover').css("display", "none");
        $('#btnConfirmDelete').css("display", "block");
        $('#actionModalLabel').text("Delete Announcement");
        $.get("{{ route('subjects.index') }}" +'/' + announcement_id, function (data) {
            var message = 'Are you sure you want to delete this announcement';
            $('#announcement_id_action').val(data.id);
            $('#actionMessage').html(message);
        })
    });

    $('body').on('click', '.recoverAnnouncement', function () {
        var announcement_id = $(this).data('id');
        $('#btnConfirmRecover').css("display", "block");
        $('#btnConfirmDelete').css("display", "none");
        $('#actionModalLabel').text("Recover Faqs");
        $.get("{{ route('faqs.index') }}" +'/' + announcement_id, function (data) {
            var message = 'Are you sure you want to recover this announcement';
            $('#announcement_id_action').val(data.id);
            $('#actionMessage').html(message);
        })
    });

    $('body').on('click', '#btnConfirmDelete', function () {
      var announcement_id = $('#announcement_id_action').val();

      $.ajax({
          type: "DELETE",
          url: "{{ route('announcement.store') }}"+'/'+announcement_id,
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
        var announcement_id = $('#announcement_id_action').val();

        $.ajax({
            url: "{{ route('announcement.recover')}}/"+announcement_id,
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

