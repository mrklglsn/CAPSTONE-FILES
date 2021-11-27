@include('parent-layout.navbars.navbar2')
      <div class="container">
        <div class="row pt-5 pl-3">
          <h3 class="account-settings">Edit Profile</h3>
        </div>
        <hr class="hr-line">
        <div class="table-responsive">
          <!-- Projects table -->
          <table class="table align-items-center table-borderless">
            <tbody class ="tfont">
            <tr>
              <th scope="col">Full Name</th>
              <td>
                <input type="text" placeholder="{{ $user->full_name }}" class="form-control">
              </td>
            </tr>
            <tr>
              <th scope="col">Username</th>
              <td>
                <input type="text" placeholder="{{ $user->username }}" class="form-control">
              </td>
            </tr>
            <tr>
              <th scope="col">Email</th>
              <td>
                <input type="text" placeholder="{{ $user->email }}" class="form-control"> 
              </td>    
            </tr>
            <tr>
              <th scope="col">Contact Number</th>
              <td>
                <input type="text" placeholder="{{ $user->contact_number }}" class="form-control">
              </td>
            </tr>
            </tbody>
          </table>
        </div>
        <div class="container pb-5">
          <div class="d-flex justify-content-end ml-5">
            <a class="btn btn-lg border-setting ml-lg-3" href="overview.html" role="button">CANCEL</a>
            <a class="btn btn-lg bg-success border-setting text-white" href="overview.html" role="button">SAVE CHANGES</a>
          </div>
        </div>
      </div>

      <div class="container">
        <div class="row pl-3">
          <h3 class="account-settings">Change Password</h3>
        </div>
        <hr class="hr-line">
        <div class="table-responsive">
          <!-- Projects table -->
          <table class="table align-items-center table-borderless">
          <thead class="thead-dark">

          </thead>
            <tbody class ="tfont">
              <tr>
                <th scope="col">Current Password</th>
                <td>
                  <input type="password" placeholder="******" class="form-control"> 
                </td>  
              </tr>
              <tr>
                <th scope="col">New Password</th>
                <td>
                  <input type="password" placeholder="******" class="form-control"> 
                </td>  
              </tr>
              <tr>
                <th scope="col">Confirm Password</th>
                <td>
                  <input type="password" placeholder="******" class="form-control"> 
                </td>
              </tr>  
            </tbody>
          </table>
        </div>
        <div class="container pb-5">
          <div class="d-flex justify-content-end ml-5">
            <a class="btn btn-lg border-setting ml-lg-3" href="overview.html" role="button">CANCEL</a>
            <a class="btn btn-lg bg-success border-setting text-white" href="overview.html" role="button">SAVE CHANGES</a>
          </div>
        </div>
      </div>
    </body>
    @include('parent-layout.footers.messaging')
</html>