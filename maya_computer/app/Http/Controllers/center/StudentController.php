<?php

namespace App\Http\Controllers\center;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\center\Student;
use App\Models\admin\Course;
use App\Models\admin\StudentRegFee;
use App\Models\center\Center;
use App\Models\center\Attendance;
use Auth;
use DB;
class StudentController extends Controller
{
    public function __construct(){
        $this->middleware(function ($request, $next) {
            define('CENTER_ID', Auth::guard('center')->user()->cl_id);
            return $next($request);
        });
    }

    public function pending_student(){
        $student['student'] = DB::table('student_login')
                            ->join('center_login', 'student_login.sl_FK_of_center_id', 'center_login.cl_id')
                            ->join('course', 'student_login.sl_FK_of_course_id', 'course.c_id')
                            ->where('student_login.sl_FK_of_center_id', CENTER_ID)
                            ->where('student_login.sl_status', 'PENDING')
                            ->get();
    	return view('center.student.pending_student',$student);
    }

    public function verified_student(){
        $student['student'] = DB::table('student_login')
                            ->join('center_login', 'student_login.sl_FK_of_center_id', 'center_login.cl_id')
                            ->join('course', 'student_login.sl_FK_of_course_id', 'course.c_id')
                            ->where('student_login.sl_FK_of_center_id', CENTER_ID)
                            ->where('student_login.sl_status', 'VERIFIED')
                            ->get();

        $attendance_batch['attendance_batch'] = Attendance::where('ab_status', 'ACTIVE')->get();
        return view('center.student.verified_student',$student,$attendance_batch);
    }

    public function result_updated_student(){
        $student['student'] = DB::table('student_login')
                            ->join('center_login', 'student_login.sl_FK_of_center_id', 'center_login.cl_id')
                            ->join('course', 'student_login.sl_FK_of_course_id', 'course.c_id')
                            ->where('student_login.sl_FK_of_center_id', CENTER_ID)
                            ->where('student_login.sl_status', 'RESULT UPDATED')
                            ->get();
        return view('center.student.result_updated_student',$student);
    }

    public function result_out_student(){
        $student['student'] = DB::table('student_login')
                            ->join('center_login', 'student_login.sl_FK_of_center_id', 'center_login.cl_id')
                            ->join('course', 'student_login.sl_FK_of_course_id', 'course.c_id')
                            ->where('student_login.sl_FK_of_center_id', CENTER_ID)
                            ->where('student_login.sl_status', 'RESULT OUT')
                            ->get();
        return view('center.student.result_out_student',$student);
    }

    public function dispatched_student(){
        $student['student'] = DB::table('student_login')
                            ->join('center_login', 'student_login.sl_FK_of_center_id', 'center_login.cl_id')
                            ->join('course', 'student_login.sl_FK_of_course_id', 'course.c_id')
                            ->where('student_login.sl_FK_of_center_id', CENTER_ID)
                            ->where('student_login.sl_status', 'DISPATCHED')
                            ->get();
        return view('center.student.dispatched_student',$student);
    }

    public function block_student(){
        $student['student'] = DB::table('student_login')
                            ->join('center_login', 'student_login.sl_FK_of_center_id', 'center_login.cl_id')
                            ->join('course', 'student_login.sl_FK_of_course_id', 'course.c_id')
                            ->where('student_login.sl_FK_of_center_id', CENTER_ID)
                            ->where('student_login.sl_status', 'BLOCK')
                            ->get();
        return view('center.student.block_student',$student);
    }

    public function student_application($id){
        $data = DB::table('student_login')
                            ->join('center_login', 'student_login.sl_FK_of_center_id', 'center_login.cl_id')
                            ->join('course', 'student_login.sl_FK_of_course_id', 'course.c_id')
                            ->where('student_login.sl_id', $id)
                            ->first();
        return view('center.student.student_application', compact('data'));
    }

    public function add_student(){
    	$course['course'] = Course::all();
        $student_reg_no = Student::where('sl_FK_of_center_id', auth::guard('center')->user()->cl_id)->latest()->first();
        $code = auth::guard('center')->user()->cl_code;
    	return view('center.student.create',$course, compact('student_reg_no', 'code'));
    }

    public function add_student_now(Request $request){
//        dd('in');
        $student_reg_fee = StudentRegFee::first();
        $center = Center::where('cl_id',Auth::guard('center')->user()->cl_id)->first();

        if($center->cl_wallet_balance < $student_reg_fee->srf_amount):
            return back()->with('error', 'Your Balance Is Low. Please Recharge');
        endif;

    	if($request->hasFile('student_photo')):
    	    $image = $request->file('student_photo');
    	    $file = time().'_'.$image->getClientOriginalName();
            $destinationPath=public_path('center/student_doc');
            $image->move($destinationPath, $file);
    	    $data['sl_photo'] = $file;
    	    $student_photo = $file;
    	endif;

    	if($request->hasFile('student_id_card')):
    	    $image = $request->file('student_id_card');
    	    $file = time().'_'.$image->getClientOriginalName();
            $destinationPath=public_path('center/student_doc');
            $image->move($destinationPath, $file);
    	    $data['sl_id_card'] = $file;
    	    $student_id_card = $file;
    	endif;

    	if($request->hasFile('student_educational_certificate')):
    	    $image = $request->file('student_educational_certificate');
    	    $file = time().'_'.$image->getClientOriginalName();
            $destinationPath=public_path('center/student_doc');
            $image->move($destinationPath, $file);
    	    $data['sl_educational_certificate'] = $file;
    	    $student_educational_certificate = $file;
    	endif;
    	$data = [
    		'sl_FK_of_course_id'					=> $request->course_id,
    		'sl_FK_of_center_id'					=> Auth::guard('center')->user()->cl_id,
    		'sl_dob'								=> $request->date_of_birth,
    		'sl_qualification'						=> $request->student_qualification,
    		'sl_reg_no'								=> $center->cl_code.$request->student_roll,
    		'sl_sex'								=> $request->student_sex,
    		'sl_address'							=> $request->student_address,
    		'sl_name'								=> $request->student_name,
    		'sl_photo'								=> $student_photo,
    		'sl_id_card'							=> $student_id_card,
    		'sl_mother_name'						=> $request->student_mother,
            'sl_mobile_no'                          => $request->student_mobile,
    		'password'							    => $request->student_mobile,
    		'sl_father_name'						=> $request->student_father,
    		'sl_educational_certificate'			=> $student_educational_certificate,
            'sl_email'                              => $request->student_email,
    		'sl_status'								=> 'PENDING',
    	];

    	$insert = Student::create($data);
        $add_transaction = DB::table('transaction')->insert([
            't_student_reg_no'      => $insert->sl_reg_no,
            't_FK_of_center_id'      => Auth::guard('center')->user()->cl_id,
            't_amount'              => $student_reg_fee->srf_amount
        ]);


        $update = Center::where('cl_id', Auth::guard('center')->user()->cl_id)->update([
            'cl_wallet_balance'         => $center->cl_wallet_balance - $student_reg_fee->srf_amount,
        ]);

        return back()->with('success', 'Student Registration Successfully!');

    	// if($insert):
    	// 	return back()->with('success', 'Student Registration Successfully!');
    	// else:
    	// 	return back()->with('error', 'Something Went Wrong!');
    	// endif;
    }

    public function edit_student($id){
        $course['course'] = Course::all();
        $student_reg_no = Student::where('sl_FK_of_center_id', auth::guard('center')->user()->cl_id)->latest()->first();
        $student_info= Student::where('sl_id',$id)->first();
//        dd($id);
        $code = auth::guard('center')->user()->cl_code;
        return view('center.student.edit',$course, compact('student_reg_no', 'code','student_info'));
//    	return view('center.student.edit');
    }

    public function update_student(Request $request){

//        dd($request->status);
        // Retrieve the student registration fee
        $student_reg_fee = StudentRegFee::first();
        // Retrieve the center based on the logged-in user's center ID
        $center = Center::where('cl_id', Auth::guard('center')->user()->cl_id)->first();

        // Check if the center's wallet balance is sufficient
        if ($center->cl_wallet_balance < $student_reg_fee->srf_amount) {
            return back()->with('error', 'Your Balance Is Low. Please Recharge');
        }

        // Retrieve the student record using the provided student ID
        $student = Student::where('sl_id',$request->student_id)->first();

        if (!$student) {
            return back()->with('error', 'Student not found');
        }

        // Initialize data array for update
        $data = [
            'sl_FK_of_course_id' => $request->course_id,
            'sl_dob' => $request->date_of_birth,
            'sl_qualification' => $request->student_qualification,
            'sl_sex' => $request->student_sex,
            'sl_address' => $request->student_address,
            'sl_name' => $request->student_name,
            'sl_mother_name' => $request->student_mother,
            'sl_mobile_no' => $request->student_mobile,
            'password' => $request->student_mobile,
            'sl_father_name' => $request->student_father,
            'sl_email' => $request->student_email,
            'sl_status' => $request->status,
        ];

        // Handle file uploads if they exist
        if ($request->hasFile('student_photo')) {
            $image = $request->file('student_photo');
            $file = time() . '_' . $image->getClientOriginalName();
            $destinationPath = public_path('center/student_doc');
            $image->move($destinationPath, $file);
            $data['sl_photo'] = $file;
        }

        if ($request->hasFile('student_id_card')) {
            $image = $request->file('student_id_card');
            $file = time() . '_' . $image->getClientOriginalName();
            $destinationPath = public_path('center/student_doc');
            $image->move($destinationPath, $file);
            $data['sl_id_card'] = $file;
        }

        if ($request->hasFile('student_educational_certificate')) {
            $image = $request->file('student_educational_certificate');
            $file = time() . '_' . $image->getClientOriginalName();
            $destinationPath = public_path('center/student_doc');
            $image->move($destinationPath, $file);
            $data['sl_educational_certificate'] = $file;
        }

        // Update the student record
        $student->update($data);

        return back()->with('success', 'Student Updated Successfully!');
    }

    public function delete_student(){

    }

    public function get_course(Request $request){
    	$get_course = Course::where('c_id',$request->course_id)->first();
    	if($get_course):
    		$data = [
    			'msg'		=> $get_course->c_duration . ' Months',
    			'status'	=> 1
    		];
    	else:
    		$data = [
    			'msg'		=> "Something Went Wrong!",
    			'status'	=> 0
    		];
    	endif;
    	return response()->json($data);
    }

    public function student_id_card(){
        $student['student'] = DB::table('center_login')
                    ->join('student_login', 'center_login.cl_id', 'student_login.sl_FK_of_center_id')
                    ->join('course', 'student_login.sl_FK_of_course_id', 'course.c_id')
                    ->where('student_login.sl_FK_of_center_id', Auth::guard('center')->user()->cl_id)
                    ->get();

        return view('center.student.id_card_list',$student);
    }

    public function view_student_id_card($id){
        $data = DB::table('student_login')
                ->join('center_login', 'student_login.sl_FK_of_center_id', 'center_login.cl_id')
                ->join('course', 'student_login.sl_FK_of_course_id', 'course.c_id')
                ->where('student_login.sl_id',$id)
                ->first();

        return view('center.student.view_student_id_card', compact('data'));
    }
}
