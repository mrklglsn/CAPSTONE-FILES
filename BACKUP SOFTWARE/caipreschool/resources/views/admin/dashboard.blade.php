@extends('layouts.app')

@section('content')
  <!-- Header -->
  <div class="header bg-gradient-green pb-3">
    <div class="container-fluid">
      <div class="header-body">
        <div class="row py-2">
          <div class="col">
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-1">
              <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                <li class="breadcrumb-item active">Dashboard</li>
              </ol>
            </nav>
          </div>
        </div>
        <!-- Card stats -->
        <div class="row">
          <div class="col-xl-4 col-md-6">
            <div class="card card-stats">
              <!-- Card body -->
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0">Total Parents</h5>
                    <span class="h2 font-weight-bold mb-0">{{ count($parents) }}</span>
                  </div>
                  <div class="col-auto">
                    <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                      <i class="fa fa-user"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-4 col-md-6">
            <div class="card card-stats">
              <!-- Card body -->
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0">Total Subjects</h5>
                    <span class="h2 font-weight-bold mb-0">{{ count($subjects) }}</span>
                  </div>
                  <div class="col-auto">
                    <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                      <i class="fa fa-book"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-4 col-md-6">
            <div class="card card-stats">
              <!-- Card body -->
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0">Total Videos</h5>
                    <span class="h2 font-weight-bold mb-0">{{ count($videos) }}</span>
                  </div>
                  <div class="col-auto">
                    <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                      <i class="fa fa-video"></i>
                    </div>
                  </div>
                </div>
                <!-- <p class="mt-3 mb-0 text-sm">
                  <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                  <span class="text-nowrap">Since last month</span>
                </p> -->
              </div>
            </div>
          </div>
          <div class="col-xl-6 col-md-6">
            <div class="card card-stats">
              <!-- Card body -->
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0">Total Faqs</h5>
                    <span class="h2 font-weight-bold mb-0">15</span>
                  </div>
                  <div class="col-auto">
                    <div class="icon icon-shape bg-gradient-gray text-white rounded-circle shadow">
                      <i class="fa fa-question"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-6 col-md-6">
            <div class="card card-stats">
              <!-- Card body -->
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-1">total announcement</h5>
                    <span class="h2 font-weight-bold mb-0">9</span>
                  </div>
                  <div class="col-auto">
                    <div class="icon icon-shape bg-gradient-blue text-white rounded-circle shadow">
                      <i class="fa fa-info"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container-fluid">
    <div class="row">
      <div class="col-xl-5 col-md-6 pt-4" style="text-align: center">
        <h4>No. of registered students per month</h4>
        <canvas id="myChart" width="400" height="400"></canvas>
      </div>

      <div class="col-xl-6 col-md-6 pt-4" style="text-align: center">
        <div class="table-responsive">
          <div>
            <h4>Top 10 Star Gainer</h4>
            <table class="table align-items-center">
                <thead class="thead-light">
                    <tr>
                        <th scope="col" class="sort" data-sort="name">Rank</th>
                        <th scope="col" class="sort" data-sort="name">Student ID</th>
                        <th scope="col" class="sort" data-sort="budget">Name</th>
                        <th scope="col" class="sort" data-sort="status">Total Star</th>
                    </tr>
                </thead>
                <tbody class="list">
                  <tr>
                    <td>1</td>
                    <td>2</td>
                    <td>John Bilee Talplacido</td>
                    <td>26</td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>5</td>
                    <td>Angelo Agarcio</td>
                    <td>20</td>
                  </tr>
                  <tr>
                    <td>3</td>
                    <td>5</td>
                    <td>Jeymar Jordan</td>
                    <td>16</td>
                  </tr>
                  <tr>
                    <td>4</td>
                    <td>1</td>
                    <td>Mark Gregorio</td>
                    <td>10</td>
                  </tr>
                  <tr>
                    <td>5</td>
                    <td>7</td>
                    <td>Anthony Olivares</td>
                    <td>7</td>
                  </tr>
                </tbody>
            </table>
          </div>
        </div>
      </div>
                      
      
    </div>
    </div>
    
  

  
  @include('layouts.footers.footer')
@endsection
@section("ajaxScript")
<script>
  const ctx = document.getElementById('myChart').getContext('2d');
  const myChart = new Chart(ctx, {
      type: 'bar',
      data: {
          labels: ['October', 'November', 'December'],
          datasets: [{
              label: '# of Votes',
              data: [7, 19, 17],
              backgroundColor: [
                  'rgba(255, 99, 132, 0.2)',
                  'rgba(54, 162, 235, 0.2)',
                  'rgba(255, 206, 86, 0.2)',
                  
              ],
              borderColor: [
                  'rgba(255, 99, 132, 1)',
                  'rgba(54, 162, 235, 1)',
                  'rgba(255, 206, 86, 1)',
              ],
              borderWidth: 1
          }]
      },
      options: {
          scales: {
              y: {
                  beginAtZero: true
              }
          }
          
      }
  });
  </script>
@endsection
  