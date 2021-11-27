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
                  <li class="breadcrumb-item active">Video Category</li>
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
                  <h3 class="mb-0 text-white">Video Category</h3>
                </div>
                <div class="mr-2">
                    <a href="#!" class="btn btn-success" data-toggle="modal" data-target="#modalVideoCategory"><i class="fa fa-plus mr-2"></i>Add Category</a>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <!-- Projects table -->
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Category ID</th>
                    <th scope="col">Category Name</th>
                    <th scope="col">Status</th>
                    <th scope="col" colspan="3">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="col">1</th>
                    <th scope="row">
                      English
                    </th>       
                    <td>
                        <span class="badge badge-success">SAVED</span>
                    </td>
                    <td>
                        <btn class="btn bg-success btn-sm text-white" href="#"><i class ="fa fa-edit mr-1"></i>Edit</btn>
                        <btn class="btn bg-danger btn-sm text-white" href="#"><i class ="fa fa-trash mr-1"></i>Delete</btn>
                    </td>
                  </tr>

                  <tr>
                    <th scope="col">2</th>
                    <th scope="row">
                      Math
                    </th>       
                    <td>
                        <span class="badge badge-success">SAVED</span>
                    </td>
                    <td>
                        <btn class="btn bg-success btn-sm text-white" href="#"><i class ="fa fa-edit mr-1"></i>Edit</btn>
                        <btn class="btn bg-danger btn-sm text-white" href="#"><i class ="fa fa-trash mr-1"></i>Delete</btn>
                    </td>
                  </tr>
                  <tr>
                    <th scope="col">3</th>
                    <th scope="row">
                      Science
                    </th>       
                    <td>
                        <span class="badge badge-success">SAVED</span>
                    </td>
                    <td>
                        <btn class="btn bg-success btn-sm text-white" href="#"><i class ="fa fa-edit mr-1"></i>Edit</btn>
                        <btn class="btn bg-danger btn-sm text-white" href="#"><i class ="fa fa-trash mr-1"></i>Delete</btn>
                    </td>
                  </tr>
                  <tr>
                    <th scope="col">4</th>
                    <th scope="row">
                      Filipino
                    </th>       
                    <td>
                        <span class="badge badge-success">SAVED</span>
                    </td>
                    <td>
                        <btn class="btn bg-success btn-sm text-white" href="#"><i class ="fa fa-edit mr-1"></i>Edit</btn>
                        <btn class="btn bg-danger btn-sm text-white" href="#"><i class ="fa fa-trash mr-1"></i>Delete</btn>
                    </td>
                  </tr>
                  <tr>
                    <th scope="col">5</th>
                    <th scope="row">
                      GMRC
                    </th>       
                    <td>
                        <span class="badge badge-success">SAVED</span>
                    </td>
                    <td>
                        <btn class="btn bg-success btn-sm text-white" href="#"><i class ="fa fa-edit mr-1"></i>Edit</btn>
                        <btn class="btn bg-danger btn-sm text-white" href="#"><i class ="fa fa-trash mr-1"></i>Delete</btn>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      @include('layouts.footers.footer')
    </div>
  @endsection
  
<div class="modal fade" id="modalVideoCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Topic</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form role="form">
          <div class="form-group mb-3">
            <p class="form-text small">Category</p>
              <div class="input-group input-group-merge input-group-alternative">
                  <input class="form-control" placeholder="Enter Category" type="question">
              </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success">Save changes</button>
      </div>
    </div>
  </div>
</div>
</html>