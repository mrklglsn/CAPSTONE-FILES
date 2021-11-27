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
                <li class="breadcrumb-item active">Topics Management</li>
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
                    <input class="form-control" placeholder="Search Topic" type="text">
                  </div>
                </div>
                  <a href="#!" class="btn btn-success" data-toggle="modal" data-target="#modalTopic"><i class="fa fa-plus mr-2"></i>Add Topic</a>
            </div>
          </div>
          <div class="table-responsive">
            <!-- Projects table -->
            <table class="table align-items-center table-flush">
              <thead class="thead-light">
                <tr>
                  <th scope="col">Topic ID</th>
                  <th scope="col">Topic Name</th>
                  <th scope="col">Status</th>
                  <th scope="col" colspan="3">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope ="row">
                      1
                  </th>
                  <th scope="row">
                    Coloring Games
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
                  <th scope ="row">
                      2
                  </th>
                  <th scope="row">
                    Counting Games
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
                  <th scope ="row">
                      3
                  </th>
                  <th scope="row">
                    Fruit Games
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
                  <th scope ="row">
                      4
                  </th>
                  <th scope="row">
                    Reading Letters
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
                  <th scope ="row">
                      5   
                  </th>
                  <th scope="row">
                    Reading Toys
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
          <nav aria-label="Page navigation example">
              <ul class="pagination justify-content-end">
                <li class="page-item disabled">
                  <a class="page-link" href="#" tabindex="-1">
                    <i class="fa fa-angle-left"></i>
                    <span class="sr-only">Previous</span>
                  </a>
                </li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                  <a class="page-link" href="#">
                    <i class="fa fa-angle-right"></i>
                    <span class="sr-only">Next</span>
                  </a>
                </li>
              </ul>
            </nav>
        </div>
      </div>
    </div>
    @include('layouts.footers.footer')
  </div>
@endsection
    

<div class="modal fade" id="modalTopic" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            <p class="form-text small">Topic</p>
              <div class="input-group input-group-merge input-group-alternative">
                  <input class="form-control" placeholder="Enter Topic" type="question">
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
