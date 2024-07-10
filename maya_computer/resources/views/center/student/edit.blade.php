@extends('center.layouts.master')
@section('title', 'Edit Student')
@push('custom-css')
    <style type="text/css">

    </style>
@endpush
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Student</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-lg-12">
            <form id='update_frm' method="post" enctype="multipart/form-data" action="{{route('update_student')}}">
                @csrf
                <div class="card">
                    <div class="card-header bg-secondary text-white font-weight-bold">
                        Student Registration Edit
                        <span class='float-right' style='float:right'>
						<a href="{{ route('student_list') }}">  <button class="btn btn-dark btn-sm" > View All </button></a>
					<button class="btn btn-success btn-sm" id="update_btn" accesskey="s"> SAVE </button>                                    </span>
                    </div>
                    <div class="card-body">
                        <div class='row'>
                            <div class="col-md-4 mb-3">
                                <!--<input type='hidden' name='status' value='PENDING'>-->
                                <input type='hidden' value ='{{@$student_info->sl_id}}' name='student_id'>
                                <input type='hidden' value ='5' name='center_id'>
                                <div class="form-group mb-3">
                                    <label>Select Course Name  <span class='badge bg-success' id='course_data' style='display:none'> </span></label>
                                    <select onchange="get_course(this.value);" class="form-select select2" name='course_id' id='course_id'  required   >
                                        <option value=''> Select Course </option>
                                        @foreach($course as $data)
                                            <option {{@$student_info->sl_FK_of_course_id == $data->c_id ? 'selected':'' }}  value="{{ $data->c_id }}">{{ $data->c_short_name }} [{{ $data->c_duration }}]</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="form-group mb-3">
                                    <label> Reg. No.
                                        <span class='badge bg-success'>

									{{ $student_reg_no->sl_reg_no ?? $code }} </span>
                                        <span id='rollNo'></span>
                                    </label>
                                    <input class="form-control" readonly  type='number' id='student_roll' placeholder="Valid 4 Digit" name='student_roll' value='{{@$student_info->sl_reg_no}}' minlength='4' maxlength='4' required>
                                </div>
                                <div class="form-group mb-3">
                                    <label>Enter Student Name</label>
                                    <input class="form-control cp" placeholder="Student Name Here" name='student_name' value='{{@$student_info->sl_name}}' required>
                                </div>
                                <div class="form-group mb-3">
                                    <label>Enter Mother's Name</label>
                                    <input class="form-control cp" placeholder="Mother's Name" name='student_mother' value='{{@$student_info->sl_mother_name}}' >
                                </div>
                                <div class="form-group mb-3">
                                    <label>Enter Father's Name</label>
                                    <input class="form-control cp" placeholder="Father's Name" name='student_father' value='{{@$student_info->sl_father_name}}' required>
                                </div>


                            </div>
                            <div class="col-md-4 mb-3">

                                <div class="form-group mb-3">
                                    <label>Date of Birth</label>
                                    <input class="form-control"  type='date' name='date_of_birth' max='2015-01-01' value='{{@$student_info->sl_dob}}'>
                                </div>
                                <div class="form-group mb-3">
                                    <label>Select Sex</label>
                                    <select class="form-select" name='student_sex' required>
                                        <option   value='' selected></option>
                                        <option  {{@$student_info->sl_sex == 'MALE' ? 'selected':'' }} value='MALE' >MALE</option>
                                        <option {{@$student_info->sl_sex == 'FEMALE' ? 'selected':'' }} value='FEMALE' >FEMALE</option>
                                        <option {{@$student_info->sl_sex == 'OTHER' ? 'selected':'' }} value='OTHER' >OTHER</option>
                                    </select>
                                </div>

                                <div class="form-group mb-3">
                                    <label>Address </label>
                                    <textarea class="form-control cp" rows="3" name='student_address'>{{@$student_info->sl_address}}</textarea>
                                </div>


                                <div class="form-group mb-3">
                                    <label>Enter Mobile No.  </label>
                                    <input class="form-control"  type='number' minlength='10' name='student_mobile' maxlength='10' value='{{@$student_info->sl_mobile_no}}' required>
                                </div>
                                <div class="form-group mb-3">
                                    <label>Enter Email Id. </label>
                                    <input class="form-control" placeholder="someone@email.com" name='student_email' type='email' value='{{@$student_info->sl_email}}' >
                                </div>
                                <input type='hidden' name='status' value='PENDING'>
                            </div>
                            <div class="col-md-4 ">
                                <div class="form-group mb-3">
                                    <label>Select Qualification </label>
                                    <select class="form-select select2 " name='student_qualification'>
                                        <option value='' selected></option>
                                        <option  {{@$student_info->sl_qualification == 'Non Matric' ? 'selected':'' }}  value='Non Matric' >Non Matric</option>
                                        <option {{@$student_info->sl_qualification == 'Matric' ? 'selected':'' }}  value='Matric' >Matric</option>
                                        <option {{@$student_info->sl_qualification == 'Intermediate' ? 'selected':'' }}  value='Intermediate' >Intermediate</option>
                                        <option  {{@$student_info->sl_qualification == 'Graduate' ? 'selected':'' }} value='Graduate' >Graduate</option>
                                        <option {{@$student_info->sl_qualification == 'Post Graduate' ? 'selected':'' }}  value='Post Graduate' >Post Graduate</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label>Upload Photograph</label>
                                    <img style="width: 47px;" src="{{ asset('center/student_doc/'.@$student_info->sl_photo) }}">
                                    <input class="form-control" type='file' name='student_photo' id='uploadimg' accept='image'>
                                </div>


                                <div class="form-group mb-3">
                                    <label>Upload Identity Card </label><br>
                                    <img style="width: 47px;" src="{{ asset('center/student_doc/'.@$student_info->sl_id_card) }}">
                                    <input class="form-control" type='file' name='student_id_card' id='upload_id_proof' accept='image'>
                                    <br><small> Scan copy of VIC, Aadhar, PAN, DL etc. </small>
                                </div>


                                <div class="form-group mb-3">
                                    <label>Upload Educational Certificate</label>
                                    <img style="width: 47px;" src="{{ asset('center/student_doc/'.@$student_info->sl_educational_certificate) }}">
                                    <input class="form-control" type='file' name='student_educational_certificate' id='upload_edu_proof' accept='image'>
                                    <br><small> Marks Sheet, Certificate etc.</small>
                                </div>
                                <div class="form-group mb-3">
                                    <label>Select Status</label>
                                    <select class="form-select" name='status' required>
                                        <option value='' selected></option>
                                        <option  {{@$student_info->sl_status == 'PENDING' ? 'selected':'' }} value='PENDING' >PENDING</option>
                                        <option {{@$student_info->sl_status == 'VERIFIED' ? 'selected':'' }} value='VERIFIED' >VERIFIED</option>
                                        <option {{@$student_info->sl_status == 'DISPATCHED' ? 'selected':'' }} value='DISPATCHED' >DISPATCHED</option>
                                        <option {{@$student_info->sl_status == 'BLOCK' ? 'selected':'' }} value='BLOCK' >BLOCK</option>
                                        <option {{@$student_info->sl_status == 'RESULT OUT' ? 'selected':'' }} value='RESULT OUT' >RESULT OUT</option>
                                    </select>
                                </div>
                            </div>
            </form>




        </div>
    </div>
    <!-- end select2 -->
    </div>
    <!-- <div class="card-footer bg-white">
            <hr>

            <hr>
    </div> -->
    </div>
    <!-- end row -->
    </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
    </div>
@endsection
@push('custom-js')
    <script type="text/javascript">
        $('.select2').select2();
        // Get Course
        function get_course(course_id){
            $.ajax({
                url: "{{ route('get_course') }}",
                type: "get",
                data: {course_id:course_id},
                dataType: "json",
                success: function(response){
                    if(response.status == 1){
                        $('#course_data').show();
                        $('#course_data').text(response.msg);
                    }
                }
            });
        }
    </script>
@endpush
