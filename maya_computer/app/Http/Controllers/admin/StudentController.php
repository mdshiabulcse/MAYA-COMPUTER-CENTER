<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\student\Student;
use App\Models\admin\Course;
use App\Models\admin\StudentRegFee;
use App\Models\center\Center;
use DB;
use Auth;
class StudentController extends Controller
{
    public function student_list(){
    	$student['student'] = DB::table('student_login')
    							->join('center_login', 'student_login.sl_FK_of_center_id', 'center_login.cl_id')
    							->join('course', 'student_login.sl_FK_of_course_id', 'course.c_id')
    							->get();
    	return view('admin.student.index',$student);
    }

    public function add_student(){
        $center   = Center::where('cl_code', '!=', '61123000')->get();
        $course = Course::all();


    	return view('admin.student.create',['center'=>$center,'course'=>$course]);
    }

    public function add_student_now(Request $request){
    	$student_reg_fee = StudentRegFee::first();
        $center = Center::where('cl_id',Auth::guard('center')->user()->cl_id)->first();

        // if($center->cl_wallet_balance < $student_reg_fee->srf_amount):
        //     return back()->with('error', 'Your Balance Is Low. Please Recharge');
        // endif;

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
    		'sl_FK_of_center_id'					=> $request->centerId,
    		'sl_dob'								=> $request->date_of_birth,
    		'sl_qualification'						=> $request->student_qualification,
    		'sl_reg_no'								=> $request->student_roll,
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


    public function get_reg_no(Request $request){
        $student_reg = Student::where('sl_FK_of_center_id', $request->center_id)->first();
        if($student_reg):
            $data = [
                'msg'       => 'Success',
                'reg_no'    => $student_reg->sl_reg_no,
                'status'    => 1
            ];
        else:
            $data = [
                'msg'       => 'Enter Center Code With 4 Digit Number',
                'status'    => 0
            ];
        endif;

        return response()->json($data);
    }

    public function edit_student(){

    }

    public function update_student(){

    }

    public function delete_student(){

    }

    public function student_status_updated(Request $request){
    	$student = Student::where('sl_id',$request->student_id)->update([
    		'sl_status'		=> $request->status
    	]);
    	if($student):
    		$data = [
    			'msg'		=> 'Student Status Updated Successfully!',
    			'status'	=> 1
    		];
    	else:
    		$data = [
    			'msg'		=> 'Something Went Wrong!',
    			'status'	=> 0
    		];
    	endif;

    	return response()->json($data);
    }

    public function student_application($id){
    	$data = DB::table('student_login')
                            ->join('center_login', 'student_login.sl_FK_of_center_id', 'center_login.cl_id')
                            ->join('course', 'student_login.sl_FK_of_course_id', 'course.c_id')
                            ->where('student_login.sl_id', $id)
                            ->first();
        return view('admin.student.student_application', compact('data'));
    }

    public function set_reg_fee(){
        $student_reg_fee = Course::get();
//        dd($student_reg_fee);
        return view('admin.set_reg_fee', compact('student_reg_fee'));
    }

    public function update_reg_fee(Request $request){
        $student_reg_fee = StudentRegFee::first();

        $update = StudentRegFee::where('srf_id',$student_reg_fee->srf_id)->update([
            'srf_amount'        => $request->amount

        ]);

        return back()->with('success', 'Registration Fees Updated Successfully!');
    }
}
