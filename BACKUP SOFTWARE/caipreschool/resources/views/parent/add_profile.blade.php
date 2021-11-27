@include('parent-layout.navbars.navbar2')
        <div class="container">
            <div class="row pt-5 pl-3">
                <h3 class="account-settings">Add Student Profile</h3>
            </div>
            <hr class="hr-line">
            <div class="table-responsive">
                <!-- Projects table -->
                <table class="table align-items-center table-borderless">
                    <thead class="thead-dark">
                        <div class="modalErrorr"></div>
                    </thead>
                    <tbody class ="tfont">
                        <form role="form" enctype="multipart/form-data" id="addStudentForm">
                            <input type="text" name="student_id" id="student_id" class="form-control" hidden> 
                            <tr>
                                <th scope="col">Student Picture</th>
                                <td>
                                    <img id="blah" src="{{ url('public/frontend/images/user1.png') }}" width="150" height="150"  />
                                    <textarea name="imagename" id="imagename" id="" cols="30" rows="10" hidden></textarea>
                                    <input type='file' name="photo" id="photo" onchange="readURL(this);" accept="image/*"/ required>   
                                    <span class="text-danger" id="errorPhoto">@error('photo'){{ $message }} @enderror</span>
                                </td>
                            </tr>
                            <tr>
                                <th scope="col">Full Name</th>
                                <td>
                                    <input type="text" name="fullName" id="fullName" placeholder="Enter full name" class="form-control" required> 
                                    <span class="text-danger" id="errorFullName"></span>
                                </td>    
                            </tr>
                            <tr>
                                <th scope="col">Nickname</th>
                                <td>
                                    <input type="text" name="nickName" id="nickName" placeholder="Enter nickname" class="form-control" required> 
                                    <span class="text-danger" id="errorNickName"></span>
                                </td>    
                            </tr>
                            <tr>
                                <th scope="col">Birth Date</th>
                                <td>
                                    <input type="date" name="birthDate" id="birthDate" class="form-control datepicker" required> 
                                    <span class="text-danger" id="errorBirthDate">@error('birthDate'){{ $message }} @enderror</span>
                                </td>    
                            </tr>
                        </form>
                    </tbody>
                </table>
            </div>
            <div class="container pb-5">
                <div class="d-flex justify-content-end ml-5">
                    <a class="btn btn-lg bg-success border-setting text-white" id="submitForm" role="button">SUBMIT</a>
                </div>
            </div>
        </div>
        @include('layouts.cropper')
    </body>
    @include('parent-layout.footers.messaging')
    <script type="text/javascript">
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });

        $('#submitForm').click(function (e) {
            e.preventDefault();
            var form = $('form')[0];
            var formData = new FormData(form);
            var errorCount = 0;
            
            $.ajax({
                type:'POST',
                url: "{{ route('parent/profile/add/submit') }}",
                data: formData,
                contentType: false,
                processData: false,
                success: (response) => {
                    if (response) {
                        $('#addStudentForm').trigger("reset");
                        Swal.fire({
                            icon: 'success',
                            title: response.success,
                        }).then(function(){
                            window.location = "{{ route('parent/home') }}";
                        });
                    }
                },
                error: function(response){
                    
                    console.log(Object.values(response.responseJSON));
                    let allErrors = Object.values(response.responseJSON)
                    .map(el => (
                        el = `<li>${el}</li>`
                    ))
                    .reduce((next, prev) => ( next = prev + next ));   
                    const setErrors = `
                    <div class="alert alert-danger" role="alert">
                        <ul>${allErrors}</ul>
                    </div>
                    `;
                    $('.modalErrorr').html(setErrors);
                }
            });
        })
         
    });
    </script>
</html>