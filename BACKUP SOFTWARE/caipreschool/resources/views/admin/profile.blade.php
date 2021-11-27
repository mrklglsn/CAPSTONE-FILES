@extends('layouts.app')

@section('content')
<!-- Header -->
<div class="header pb-6 d-flex align-items-center" style="min-height: 400px; background-image: {{ url('public/frontend/img/theme/profile-cover.jpg') }}; background-size: cover; background-position: center top;">
  <!-- Mask -->
  <span class="mask bg-gradient-default opacity-8"></span>
  <!-- Header container -->
  <div class="container-fluid d-flex align-items-center">
    <div class="row">
      <div class="col-lg-7 col-md-10">
        <h1 class="display-2 text-white">{{ $userInfo->full_name }}</h1>
        <p class="text-white mt-0 mb-5">This is your profile page. You can see the progress you've made with your work and manage your projects or assigned tasks</p>
      </div>
    </div>
  </div>
</div>
  <!-- Page content -->
  <div class="container-fluid mt--6">
    <div class="row">
      <div class="col-xl-8 order-xl-1">
        <div class="card card-profile">
          <div class="row justify-content-center">
              <div class="card-profile-image">
                <a href="#">
                  <img src="{{ asset('storage/app/public/images/'.$userInfo->photo_file_name) }}" class="rounded-circle">
                </a>
              </div>
            </div>
          <div class="card-header text-center border-0 pt-4 pl-10 pb-md-4">
            <div class="d-flex justify-content-end">
              <a href="#" class="btn btn-sm btn-default float-right" data-toggle="modal" data-target="#modalPhoto">Change Photo</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-8 order-xl-1">
        <div class="card">
          <div class="card-header">
            <div class="row align-items-center">
              <div class="col-8">
                <h3 class="mb-0">Edit profile </h3>

              </div>
            </div>
          </div>
          <div class="card-body">
            <div id="messageArea"></div>
            <form>
              <h6 class="heading-small text-muted mb-4">User information</h6>
              <div class="pl-lg-4">
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <input type="text" id="username" class="form-control" value="{{ $userInfo->id }}" hidden>
                      <label class="form-control-label" for="input-username">Username</label>
                      <input type="text" id="username" class="form-control" value="{{ $userInfo->username }}" disabled>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="input-email">Email address</label>
                      <input type="email" id="input-email" class="form-control" value="{{ $userInfo->email }}" disabled>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <div class="form-group">
                      <label class="form-control-label" for="input-first-name">Full name</label>
                      <input type="text" id="input-first-name" class="form-control" value="{{ $userInfo->full_name }}" disabled>
                    </div>
                  </div>
                </div>
                <div class="d-flex justify-content-end">
                  <a href="#" class="btn btn-sm btn-default float-right" data-toggle="modal" data-target="#modalEdit">Edit Profile</a>
                </div>
              </div>
            </form>
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

    $('#saveChanges').click(function (e) {
      e.preventDefault();

      $.ajax({
        data: $('#editUserDetails').serialize(),
        url: "{{ route('profile.store') }}",
        type: "POST",
        dataType: 'json',
        success: function (data) {
            var successHtml = '<div class="alert alert-danger">'+data.success+'</div>';
            $('#messageArea').html(successHtml);
            $('#modalEdit').modal('toggle');
            location.reload();
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

  $('#upload-image-form').submit(function(e) {
      e.preventDefault();
      let formData = new FormData(this);
      $('#image-input-error').text('');

      $.ajax({
        type:'POST',
        url: "{{ route('photo.store') }}",
        data: formData,
        contentType: false,
        processData: false,
        success: (response) => {
          if (response) {
            this.reset();
            location.reload();  
          }
        },
        error: function(response){
          console.log(response);
            $('#image-input-error').text(response.responseJSON.errors.file);
        }
      });
    });

    $(".custom-file-input").on("change", function() {
      var fileName = $(this).val().split("\\").pop();
      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });

  });

</script>

@endsection
<div class="modal fade" id="modalPhoto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Change Photo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form role="form" id="upload-image-form" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="form-group mb-3">
            <input class="form-control" name="change_id" value="{{ $userInfo->id }}" hidden>
            <p class="form-text small">File Name</p>
            <div class="input-group input-group-merge input-group-alternative">
              <div class="custom-file">
                <input type="file" class="custom-file-input" name="photo" id="photo" accept="image/*">
                <label class="custom-file-label" for="photo">Choose file</label>
              </div>
            </div>    
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success" id="savePhoto">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form role="form" id="editUserDetails">
          <div class="form-group mb-3">
            <input class="form-control" name="edit_id" value="{{ $userInfo->id }}" hidden>
            <p class="form-text small">Username</p>
              <div class="input-group input-group-merge input-group-alternative">
                  <input class="form-control" name="username" value="{{ $userInfo->username }}" type="question">
              </div>
          </div>
          <div class="form-group mb-3">
            <p class="form-text small">Email Address</p>
              <div class="input-group input-group-merge input-group-alternative">
                  <input class="form-control" name="email" value="{{ $userInfo->email }}" type="question">
              </div>
          </div>
          <div class="form-group mb-3">
            <p class="form-text small">Full name</p>
              <div class="input-group input-group-merge input-group-alternative">
                  <input class="form-control" name="edit_full_name" value="{{ $userInfo->full_name }}" type="question">
              </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success" id="saveChanges">Save changes</button>
      </div>
    </div>
  </div>
</div>





