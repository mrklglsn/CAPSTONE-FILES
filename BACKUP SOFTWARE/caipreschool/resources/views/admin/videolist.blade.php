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
                <li class="breadcrumb-item active">Video List</li>
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
              <div class="mr-2">
                  <a href="#!" class="btn btn-success addVideo" data-toggle="modal" data-target="#modalVideoList"><i class="fa fa-plus mr-2"></i>Add Video</a>
              </div>
            </div>
          </div>
          <div class="table-responsive">
            <!-- Projects table -->
            <table class="table align-items-center table-flush" id="data-table-videos">
              <thead class="thead-light">
                <tr>
                  <th scope="col">Video ID</th>
                  <th scope="col">Title</th>
                  <th scope="col">Description</th>
                  <th scope="col">Category</th>
                  <th scope="col">File name</th>
                  <th scope="col">Thumbnail</th>
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
     
      var table = $('#data-table-videos').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('videos.index') }}",
          columns: [
              {data: 'id', name: 'id'},
              {data: 'video_title', name: 'video_title'},
              {data: 'video_desc', name: 'video_desc'},
              {data: 'category', name: 'category'},
              {data: 'video_file_name', name: 'video_file_name'},
              {data: 'video_thumbnail', name: 'video_thumbnail'},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });

      $('#uploadVideoForm').submit(function(e) {
        e.preventDefault();
        let formData = new FormData(this);
       
        $.ajax({
          type:'POST',
          url: "{{ route('videos.store') }}",
          data: formData,
          contentType: false,
          processData: false,
          success: (response) => {
            if (response) {
              $('#uploadVideoForm').trigger("reset");
              var successHtml = '<div class="alert alert-danger">'+response.success+'</div>';
              $('#messageArea').html(successHtml);
              $('#modalVideoList').modal('toggle');
              table.draw();
            }
          },
          error: function(response){
            console.log(response);
              $('#image-input-error').text(response.responseJSON.errors.file);
          }
        });
      });

      vPlayer = videojs('example_video_1', {
            techOrder: ["html5"],
            autoplay: false,
      });   
          
      $('body').on('click', '.viewVideo', function () {
        var video_id = $(this).data('id');
        
        $.get("{{ route('videos.index') }}" +'/' + video_id, function (data) {
          $('#viewVideoDesc').text(data.video_desc);
          $('#viewVideoTitle').text(data.video_title);
        
          vPlayer.poster("{{ url('public/storage/images/') }}/"+data.video_thumbnail);
          vPlayer.src("{{ url('public/storage/videos/') }}/"+data.video_file_name);
        })
      });

      $('body').on('click', '.addVideo', function () {
        $('#uploadVideoForm').trigger("reset");
        $('#exampleModalLabel').text("Upload Videos");
        $('#videoLabel').text("Choose video file only");
        $('#photoLabel').text("Choose photo file only");
      });


      $('body').on('click', '.editVideo', function () {
        var video_id = $(this).data('id');
        $('#uploadVideoForm').trigger("reset");
        $('#exampleModalLabel').text("Edit Faqs");
        $.get("{{ route('videos.index') }}" +'/' + video_id, function (data) {
            $('#video_id').val(data.id);
            $('#videoLabel').text(data.video_file_name);
            $('#photoLabel').text(data.video_thumbnail);
            $('#video_title').val(data.video_title);
            $('#video_desc').val(data.video_desc);
            $('#category').text(data.category);
        })
      });


      $('#searchBar').on('keyup change', function(){
        table.search($(this).val()).draw();
        
      })

      $(".dataTables_filter").hide();
     
      $(".close").on("click", function(){
        vPlayer.pause();
      });

      $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
      });
  });
  </script>
@endsection

<div class="modal fade" id="modalVideoList" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Video</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form role="form" id="uploadVideoForm" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="form-group mb-3">
            <p class="form-text small">Video File</p>
            <input type="text" name="video_id" id="video_id" hidden>
            <div class="input-group input-group-merge input-group-alternative">
              <div class="custom-file">
                <input type="file" class="custom-file-input" name="video" id="video" accept="video/*">
                <label class="custom-file-label" id="videoLabel" for="video">Choose video file only</label>
              </div>
            </div>  
          </div>
          <div class="form-group mb-3">
            <p class="form-text small">Thumbnail</p>
            <div class="input-group input-group-merge input-group-alternative">
              <div class="custom-file">
                <input type="file" class="custom-file-input" name="photo" id="photo" accept="image/*">
                <label class="custom-file-label" id="photoLabel" for="photo">Choose image file only</label>
              </div>
            </div>  
          </div>
          <div class="form-group mb-3">
            <p class="form-text small">Title</p>
              <div class="input-group input-group-merge input-group-alternative">
                  <input class="form-control" name="video_title" id="video_title" placeholder="Enter Video title" type="question">
              </div>
          </div>
          <div class="form-group mb-3">
            <p class="form-text small">Description</p>
              <div class="input-group input-group-merge input-group-alternative">
                  <input class="form-control" name="video_desc" id="video_desc" placeholder="Enter Video Description" type="question">
              </div>
          </div>
          <div class="form-group mb-3">
            <p class="form-text small">Category</p>
              <div class="input-group input-group-merge input-group-alternative">
                  <select name="video_category" id="video_category" class="form-control">
                    <option value ="Math">Math</option>
                    <option value ="Science">Science</option>
                    <option value ="Reading and Writing">Reading and Writing</option>
                  </select>
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success" id="saveVideo">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="modalViewVideo" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">View Video</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form role="form">
          <div class="form-group" id="divVideo">
            <video id="example_video_1" class="video-js vjs-default-skin vjs-big-play-centered"
              controls preload="auto" width="440" height="264"
              data-setup='{"example_option":true}'>
            </video>
             
          </div>
          <div class="form-group">
            <p class="form-text small">Video Title</p>
            <div class="input-group input-group-merge input-group-alternative p-3">
              <h4 id="viewVideoTitle">Veggies veggies</h4>
            </div>
          </div>
          <div class="form-group mb-3">
            <p class="form-text small">Video Description</p>
              <div class="input-group input-group-merge input-group-alternative p-3">
                <p class="small" id="viewVideoDesc">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Velit illo dicta eius nesciunt quisquam amet repudiandae sint enim perspiciatis in! Quia ratione nemo pariatur culpa nam consequatur dolorem voluptates delectus.</p>
              </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>