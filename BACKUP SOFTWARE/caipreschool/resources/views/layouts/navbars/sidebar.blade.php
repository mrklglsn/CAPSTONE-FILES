<style>
  .sidenav {
    width: 0px;
    overflow:hidden;
    background: green;
    
    -webkit-transition: width 0.3s;
    -moz-transition: width 0.3s;
    -ms-transition: width 0.3s;
    -o-transition: width 0.3s;
    transition: width 0.3s;
}

.sidenav ul {
    width: 250px;
}
.sidenav.open {
    width: 200px;
}

</style>
<!-- Sidenav -->
<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header  align-items-center">
        <a class="navbar-brand" href="javascript:void(0)">
          <img src="{{ url('public/frontend/img/brand/blue-1.png') }}" class="navbar-brand-img" alt="...">
        </a>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
           <!-- Heading -->
           <h6 class="navbar-heading p-0 text-muted">
             <span class="docs-normal">Reports</span>
           </h6>
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" href="{{ route('dashboard') }}">
                <i class="fa fa-tachometer-alt text-primary"></i>
                <span class="nav-link-text">Dashboard</span>
              </a>
            </li>
            </ul>
            <h6 class="navbar-heading p-0 mt-2 text-muted">
              <span class="docs-normal">Management</span>
            </h6>
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="{{ route('dashboard.manageparents') }}" id="navbardrop">
                    <i class="fa fa-user-shield text-purple"></i>
                    <span class="nav-link-text">Parent Management</span>
                </a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link" href="{{ route('dashboard.managestudents') }}" id="navbardrop">
                <i class="fa fa-users-cog text-green"></i>
                <span class="nav-link-text">Student Management</span>
              </a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="{{ route('dashboard.managesubjects') }}" data-toggle="dropdown" id="navbardrop">
                <i class="fa fa-book text-orange"></i>
                <span class="nav-link-text">Subjects Management</span>
              </a>
              <div class="dropdown-menu">
                <a class="dropdown-item text-center" href="{{ route('dashboard.managesubjects') }}">Subject Lists</a>
                <a class="dropdown-item text-center" href="{{ route('dashboard.manageassessments') }}">Manage Assessments</a>
              </div>
            </li>
            
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="" data-toggle="dropdown">
                <i class="fa fa-video text-danger"></i>
                <span class="nav-link-text">Video Management</span>
              </a>
              <div class="dropdown-menu">
                <a class="dropdown-item text-center" href="{{ route('dashboard.managevideos') }}">Video List</a>
                <a class="dropdown-item text-center" href="{{ route('dashboard.managecategories') }}">Category</a>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('dashboard.managefaqs') }}">
                <i class="fa fa-question text-gray"></i>
                <span class="nav-link-text">FAQs Management</span>
              </a>              
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('dashboard.manageannouncements') }}">
                <i class="fa fa-info text-gray"></i>
                <span class="nav-link-text">Announcement Management</span>
              </a>
              <hr class="my-2">              
            </li>
          </ul>
          <!-- Divider -->
          <!-- Heading -->
          <!-- Navigation -->
        </div>
      </div>
    </div>
  </nav>