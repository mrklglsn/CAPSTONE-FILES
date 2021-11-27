@include('parent-layout.navbars.navbar2')
          <div class="container">
            
              <div class="row pt-5 pl-3">
                  <h3 class="account-settings">Account Settings</h3>
              </div>
              <hr class="hr-line">
              <div class="table-responsive">
                  <!-- Projects table -->
                  <table class="table align-items-center table-borderless">
                    <thead class="thead-dark">

                    </thead>
                    <tbody class ="tfont">
                      <tr>
                        <th scope="col">Full Name</th>
                        <td>{{ $user->full_name }}</td>    
                      </tr>
                      <tr>
                        <th scope="col">Username</th>
                        <td>{{ $user->username }}</td>
                      </tr>
                      <tr>
                        <th scope="col">Email</th>
                        <td>{{ $user->email }}</td>    
                      </tr>
                      <tr>
                        <th scope="col">Password</th>
                        <td>********</td>    
                      </tr>
                      <tr>
                        <th scope="col">Contact Number</th>
                        <td>09109382141</td>    
                      </tr>
                    </tbody>
                  </table>
              </div>
                <div class="container">
                  <div class="d-flex justify-content-center">
                    <a class="btn btn-lg border-profile d-flex" href="{{ route('parent/profile_edit', Session::get('LoggedUser')) }}" role="button">EDIT PROFILE</a>
                  </div>
                </div>
              <div class="row pt-5 pl-3">
                <h3 class="account-settings">Manage Student Profile</h3>
            </div>
            <hr class="hr-line">
            <div class="table-responsive">
              <div class="row d-inline-flex">
                @foreach ($students as $student)
                  <div class="col-4 col-sm-3" style="margin-left: 30px;" >
                    <a class="btn" href="{{ route('parent/profile/view', $student->id)}}">
                        <img src="{{ url('public/storage/images/'.$student->profile_pic) }}" style="object-fit: cover;width:130px; height:130px;" class="card-img-top">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title text-center">{{ ucwords($student->nickname) }}</h5>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
        </div>
  </body>
  @include('parent-layout.footers.messaging')
  
</html>