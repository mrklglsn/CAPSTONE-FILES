@include('parent-layout.navbars.navbar2')
      <style>
        table.dataTable thead tr {
          background-color: #004A69;
          color: white;
        }
        table.dataTable tbody tr {
          background-color: #ffffff00;
          
        }
        table.dataTable{
          width: 100%;
        }
        .tab-contents{
          background-color: #ffffffb6;
          padding: 0 10px 0 10px;
        }
        td {
          text-transform:capitalize;
        }
      </style>
      <div class="tabs">
        <div class="container">
          <div class="row pt-5 pl-3">
              <h3 class="account-settings">{{ ucwords($student->nickname) }}'s Profile</h3>
          </div>
          <hr class="hr-line">
          <div class="table">
            <table class="table align-items-center table-borderless">
              <thead class="tfont thead-dark">
              </thead>
              <tbody class ="tfont">
                <tr>
                  <th>Student Picture</th>
                  <td>
                    <img src="{{ url('public/storage/images/'.$student->profile_pic) }}" style="object-fit: cover;width:130px; height:130px;">
                  </td>
                </tr>
                <tr>
                  <th>Student ID</th>
                  <td>{{ ucwords($student->id) }}</td>
                </tr>
                <tr>
                  <th>Name</th>
                  <td>{{ ucwords($student->student_name) }}</td>    
                </tr>
                <tr>
                  <th>Nickname</th>
                  <td>{{ ucwords($student->nickname) }}</td>    
                </tr>
                <tr>
                    <th>Age</th>
                    <td>
                      <?php 
                        $bday = new DateTime($student->birth_date); // Your date of birth
                        $today = new Datetime(date('m.d.y'));
                        $diff = $today->diff($bday);
                        echo(date("Y") - $bday->format('Y'));
                      ?>
                    </td>    
                </tr>
                <tr>
                  <th>BirthDate</th>
                  <td>{{ $student->birth_date }}</td>    
                </tr>
              </tbody>
            </table>
          </div>
          <div class="container">
            <div class="d-flex justify-content-center">
            <a class="btn btn-lg border-profile m-2" data-toggle="modal" data-target="#modalDelete">DELETE PROFILE</a>
            <a class="btn btn-lg border-profile m-2" href="{{ route('parent/profile/edit', $student->id) }}" role="button">EDIT PROFILE</a>
            </div>
          </div>
        </div>
        <div class="row pt-5 pl-3">
          <h3 class="account-settings">{{ ucwords($student->nickname) }}'s Activity History</h3>
      </div>
      <hr class="hr-line">
        <div class="tab-button-outer pt-3">
          <ul id="tab-button">
            <li><a href="#tab01" class="tfont tabbing">Activity Log</a></li>
            <li><a href="#tab02" class="tfont tabbing">Assessment Log</a></li>
          </ul>
        </div>

          <div class="tab-select-outer">
            <select id="tab-select" class="tfont">
              <option value="#tab01">Activity Log</option>
              <option value="#tab02">Assessment Log</option>
            </select>
          </div>

          <div id="tab01" class="tab-contents">
            <div class="row pl-4 py-2">
              
          </div>
            <div class="table-responsive">
              <!-- Projects table -->
              <table class="table align-items-center" id="data-table-activity-log">
                <thead class="">
                  <th scope="col">No.</th>
                  <th scope="col">Subject</th>
                  <th scope="col">Game Title</th>
                  <th scope="col">Date/Time</th>
                </thead>
                <tbody class ="tfont1">
                 
                </tbody>
              </table>
            </div>
            <div class="container">
              <div class="d-flex justify-content-center">
              <a class="btn btn-lg border-setting ml-lg-3" href="" role="button" onclick = "window.print()"><i class="fa fa-print pr-2"></i>PRINT GENERATED REPORTS</a>
              </div>
            </div>
          </div>
          <div id="tab02" class="tab-contents">
            <div class="row pl-4 py-2">
          </div>
            <div class="table-responsive">
              <!-- Projects table -->
              <table class="table align-items-center" id="data-table-assessment-log">
                <thead class="">
                    <th scope="col">No.</th>
                    <th scope="col">Title</th>
                    <th scope="col">Performance</th>
                    <th scope="col">Date/Time</th>
                </thead>
                <tbody class ="tfont1">
                  
                </tbody>
              </table>
            </div>
            <div class="container">
              <div class="d-flex justify-content-center">
              <a class="btn btn-lg border-setting ml-lg-3" href="" role="button" onclick = "window.print()"><i class="fa fa-print pr-2"></i>PRINT GENERATED REPORTS</a>
              </div>
            </div>    
          </div>
        </div>
        <br><br><br>
      </div>
    </body>
    @include('parent-layout.footers.messaging')
    
    <script type="text/javascript">
      $(function () {
        $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
        });
        
        var activityTable = $('#data-table-activity-log').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('activity_record.index') }}",
            columns: [
                {data: null},
                {data: 'subject', name: 'subject'},
                {data: 'game_title', name: 'game_title'},
                {data: 'finished_at', name: 'finished_at'},
            ],
        });
        activityTable.on( 'order.dt search.dt', function () {
            activityTable.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            } );
        }).draw();

        var assessmentTable = $('#data-table-assessment-log').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('assessment_record.index') }}",
            columns: [
                {data: null},
                {data: 'title', name: 'title'},
                {data: 'starsCount', name: 'starsCount'},
                {data: 'finished_at', name: 'finished_at'},
            ],
        });
        assessmentTable.on( 'order.dt search.dt', function () {
          assessmentTable.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            } );
        }).draw();

       
        $(".dataTables_filter").hide();
        
        $('body').on('click', '#tab-button', function () {
          $('#data-table-assessment-log').width('100%');
          console.log("clicking");
        });
        $('.tabbing').on( 'click', function (e) {
          assessmentTable.columns.adjust();
        });
      });
    </script>
   
</html>

