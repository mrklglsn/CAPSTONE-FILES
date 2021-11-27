@extends('parent-layout.app')

@section('content')
  <div class="container">
      <div class="row justify-content-center py-5">
          <h3 class="add-student-header">Student Profile</h3>
      </div>

      <div class="row d-inline-flex">
          @foreach ($students as $student)
            <div class="col-6 col-sm-3">
              <a class="btn" href="{{ route('student/home', $student->id) }}">
                  <img src="{{ url('public/storage/images/'.$student->profile_pic) }}"  class="card-img-top">
              </a>
              <div class="card-body">
                  <h5 class="card-title text-center">{{ ucwords($student->nickname) }}</h5>
              </div>
            </div>
          @endforeach
          <div class="col-6 col-sm-3">
            <a class="btn" href="{{ route('parent/profile/add') }}">
                <img src="{{ url('public/frontend/images/add.png') }}" class="card-img-top" >
            </a>
            <div class="card-body">
                <h5 class="card-title text-center">Add New</h5>
            </div>
          </div>
      </div>
  </div>
@endsection


<div class="modal fade" id="modalPassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header header-main text-white">
        <h5 class="modal-title" id="exampleModalLabel">Settings</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label for="password" class="control-label">Enter Password:</label>
            <div>
                <input id="password" type="password" class="form-control" name="password"    autofocus>
            </div>
        </div>
      </div>
      <div class="modal-footer footer-text">
        <a  class="btn btn-danger" data-dismiss="modal">Close</a>
        <a  class="btn btn-success" href="overview.html">Confirm</a>
      </div>
    </div>
  </div>
</div>
@include('parent-layout.footers.messaging')