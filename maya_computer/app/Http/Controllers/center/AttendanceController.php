<?php

namespace App\Http\Controllers\center;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\center\Attendance;
use App\Models\center\MarkAttendance;
use App\Models\center\Student;
use Auth;
use DB;
use Carbon\Carbon;
class AttendanceController extends Controller
{

    public function attndance_batch(){
    	$attndance_batch['attndance_batch'] = Attendance::all();
    	return view('center.attendance.create',$attndance_batch);
    }

    public function attndance_batch_create(Request $request){
    	$data = [
    		'ab_FK_of_center_id'		=> Auth::guard('center')->user()->cl_id,
    		'ab_name'					=> $request->batch_name,
    		'ab_start_time'				=> $request->start_time,
    		'ab_end_time'				=> $request->end_time,
    		'ab_status'					=> $request->status,
    	];

    	$insert = Attendance::create($data);
    	if($insert):
    		return back()->with('success', 'New Batch Added Successfully!');
    	else:
    		return back()->with('error', 'Something Went Wrong!');
    	endif;
    }

    public function attndance_batch_delete($id){
    	$data = Attendance::where('ab_id',$id)->delete();
    	if($data):
    		return back()->with('success', 'Batch Deleted Successfully!');
    	else:
    		return back()->with('error', 'Something Went Wrong!');
    	endif;
    }

    // Make Attendance
    public function make_attendance(){
        $batch_id = request()->get('batch_id');
        $batch['batch'] = Attendance::all();
        $student['student'] = DB::table('attendence_set')
                    ->join('student_login', 'attendence_set.as_FK_of_student_id', 'student_login.sl_id')
                    ->where('attendence_set.as_FK_of_attendance_batch_id', $batch_id)
                    ->get();
    	return view('center.attendance.make_attendance', $batch,$student);
    }

    public function mark_attendance(Request $request){
        // dd(request()->get('batch_id'));
        $validatedData = $request->validate([
            'attd.*' => 'required|boolean', // Assuming the value of each checkbox is a boolean
        ]);

        foreach ($validatedData['attd'] as $studentId => $present) {
            // Check if attendance already exists for the student on the current date
            $existingAttendance = MarkAttendance::where('am_FK_of_student_id', $studentId)
                ->where('am_date', now()->toDateString())
                ->exists();

            if (!$existingAttendance) {
                $attendance = new MarkAttendance();
                $attendance->am_FK_of_batch_id = request()->get('batch_id');
                $attendance->am_FK_of_center_id = Auth::guard('center')->user()->cl_id;
                $attendance->am_FK_of_student_id = $studentId;
                $attendance->am_date = now()->toDateString();
                $attendance->am_status = 'PRESENT';
                $attendance->save();
            }
        }

        return redirect()->back()->with('success', 'Attendance marked successfully');
    }

    public function attendance_report(){
        $batch = Attendance::all();
        // Get all students
        $students = Student::where('sl_FK_of_center_id', Auth::guard('center')->user()->cl_id)->get();

        // Get all dates within the past month
        $startDate = Carbon::now()->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();
        $dates = [];
        $currentDate = $startDate->copy();
        while ($currentDate <= $endDate) {
            $dates[] = $currentDate->toDateString();
            $currentDate->addDay();
        }

        // Get attendance data for each student for all dates
        $attendanceReport = [];
        foreach ($students as $student) {
            $attendance = MarkAttendance::select('am_date', 'am_status')
                ->where('am_FK_of_student_id', $student->sl_id)
                ->whereBetween('am_date', [$startDate, $endDate])
                ->where('am_FK_of_center_id',Auth::guard('center')->user()->cl_id)
                ->get()
                ->groupBy('am_date')
                ->map(function ($dateGroup) {
                    return $dateGroup->max('am_status');
                });

            $attendanceReport[$student->sl_name] = [];
            foreach ($dates as $date) {
                $attendanceReport[$student->sl_name][$date] = $attendance[$date] ?? 'No';
            }
        }

    	return view('center.attendance.attndance_report', ['batch'=>$batch,], compact('attendanceReport','dates'));
    }
}
