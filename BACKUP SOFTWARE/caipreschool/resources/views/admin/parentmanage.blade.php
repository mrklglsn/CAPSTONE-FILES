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
                  <li class="breadcrumb-item active">Parent Management</li>
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
                      <input class="form-control" id = "searchBar" placeholder="Search Parent" type="text">
                     </div>
                  </div>
                  <br>
              </div>
            </div>
            <br>
            <div id="messageArea"></div>
           
            @if(session()->has('success'))
              <div class="alert alert-success">
                  {{ session()->get('success') }}
              </div>
            @endif

            <div class="table-responsive">
              <!-- Projects table -->
              <table class="table table-fluid align-items-center table-flush" id="data-table">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Parent ID</th>
                    <th scope="col">Username</th>
                    <th scope="col">Full Name</th>
                    <th scope="col">Email</th>
                    <th scope="col" class="deletedAt">Deleted At</th>
                    <th scope="col">Action</th> 
                  </tr>
                </thead>
                <tbody>
                   
                </tbody>
              </table>
              <br>
            </div>
          </div>
        </div>
      </div>
  </div>
  @include('layouts.footers.footer')
  <div class="modal fade" id="modalEditParent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Parent</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="alert alert-success" id="alertMessage" style="display: none">
           
          </div>
          <form role="form" id="editForm" name="modalForm">
            <input class="form-control" id="user_id" name="id" type="text" hidden>
            <div class="form-group mb-3">
              <p class="form-text small">Username</p>
                <div class="input-group input-group-merge input-group-alternative">
                    <input class="form-control" id="username" name="username" placeholder="Enter Video title" type="text">
                </div>
            </div>
            <div class="form-group mb-3">
              <p class="form-text small">Full Name</p>
                <div class="input-group input-group-merge input-group-alternative">
                    <input class="form-control" id="fullname" name="fullname" placeholder="Enter Video title" type="text">
                </div>
            </div>
            <div class="form-group mb-3">
              <p class="form-text small">Email</p>
                <div class="input-group input-group-merge input-group-alternative">
                    <input class="form-control" id="email" name="email" placeholder="Enter Video title" type="text">
                </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-success" id="saveBtn">Save changes</button>
        </div>
      </div>
    </div>
  </div>
  
  
  <div class="modal fade" id="modalRecoverParent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Recover Parent</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form role="form" id="recoverForm" name="modalForm">
            <input class="form-control" id="user_id_recover" name="id" type="text" hidden>
            <h5 id="deleteMessage">Are you sure you want to delete/disable <strong><span class="selectedUser"></span>'s</strong> account </h5>
            <h5 id="recoverMessage" style="display: none">Are you sure you want to recover/enable <strong><span class="selectedUser"></span>'s</strong> account </h5>
          
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
          <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalRecoverParent" id="btnConfirmDelete" >Yes</button>
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalRecoverParent" id="btnConfirmRecover" style="display: none">Yes</button>
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
     
      var table = $('#data-table').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('users.index') }}",
          columns: [
              {data: 'id', name: 'id'},
              {data: 'username', name: 'username'},
              {data: 'full_name', name: 'full_name'},
              {data: 'email', name: 'email'},
              {data: 'deleted_at', name: 'deleted_at'},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });

      $('body').on('click', '.editParent', function () {
        var parent_id = $(this).data('id');
        
        $.get("{{ route('users.index') }}" +'/' + parent_id, function (data) {
            $('#user_id').val(data.id);
            $('#username').val(data.username);
            $('#fullname').val(data.full_name);
            $('#email').val(data.email);   
        })
      });
     
      $('body').on('click', '.close', function () {
        $('#alertMessage').hide().html("");
      });

      $('#searchBar').on('keyup change', function(){
        table.search($(this).val()).draw();
        
      })

      $(".dataTables_filter").hide();

      $('#saveBtn').click(function (e) {
        e.preventDefault();

        $.ajax({
          data: $('#editForm').serialize(),
          url: "{{ route('users.store') }}",
          type: "POST",
          dataType: 'json',
          success: function (data) {
              $('#alertMessage').show().html(data.success);
              table.draw();
        
          },
          error: function (data) {
              console.log('Error:', data);
          }
        });
      });

      $('body').on('click', '.recoverParent', function () {
        var parent_id = $(this).data('id');
        $('#btnConfirmRecover').css("display", "block");
        $('#btnConfirmDelete').css("display", "none");
        $('#deleteMessage').hide();
        $('#recoverMessage').show(); 
        $.get("{{ route('users.index') }}" +'/' + parent_id, function (data) {
            $('#user_id_recover').val(data.id);
            $('.selectedUser').html(data.username);
           
        })
      });

      $('body').on('click', '.deleteParent', function () {
        var parent_id = $(this).data('id');
        $('#btnConfirmRecover').css("display", "none");
        $('#btnConfirmDelete').css("display", "block");
        $('#deleteMessage').show();
        $('#recoverMessage').hide();
        $.get("{{ route('users.index') }}" +'/' + parent_id, function (data) {
            $('#user_id_recover').val(data.id);
            $('.selectedUser').html(data.username);  
            
        })
      });

      $('body').on('click', '#btnConfirmDelete', function () {
        var parent_id = $('#user_id_recover').val();

        $.ajax({
            type: "DELETE",
            url: "{{ route('users.store') }}"+'/'+parent_id,
            success: function (data) {
                var successHtml = '<div class="alert alert-danger">'+data.success+'</div>';
                $('#messageArea').html(successHtml);
                $('#modalRecoverParent').hide();
                table.draw();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
      });

      $('body').on('click', '#btnConfirmRecover', function () {
        var parent_id = $('#user_id_recover').val();

        $.ajax({
            url: "{{ route('users.recover')}}/"+parent_id,
            success: function (data) {
                var successHtml = '<div class="alert alert-primary">'+data.success+'</div>';
                $('#messageArea').html(successHtml);
                $('#modalRecoverParent').hide();
                table.draw();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
      });
     
  });
  </script>
 
@endsection



