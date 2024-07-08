<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\admin\CenterController;
use App\Http\Controllers\admin\CourseController;
use App\Http\Controllers\admin\StudentController;
use App\Http\Controllers\admin\CenterPaymentController;
use App\Http\Controllers\admin\IncomeExpenseController;


Route::get('admin/login', [AuthController::class, 'admin_login'])->name('admin_login');
Route::post('admin/login', [AuthController::class, 'admin_login_now'])->name('admin_login');

Route::group(['prefix'=>'admin', 'middleware'=>'admin:admin'], function(){
	Route::get('dashboard', [AuthController::class, 'admin_dashboard'])->name('admin_dashboard');
	Route::get('logout', [AuthController::class, 'admin_logout'])->name('admin_logout');
	
	// Center
	Route::get('center-list', [CenterController::class, 'center_list'])->name('center_list');
	Route::get('add-center', [CenterController::class, 'add_center'])->name('add_center');
	Route::post('add-center', [CenterController::class, 'add_center_now'])->name('add_center'); 
	Route::get('edit-center/{id}', [CenterController::class, 'edit_center'])->name('edit_center');
	Route::post('edit-center/{id}', [CenterController::class, 'update_center'])->name('edit_center'); 
	Route::get('delete-center/{id}', [CenterController::class, 'delete_center'])->name('delete_center'); 
	Route::get('center-account-status', [CenterController::class, 'center_status'])->name('center.status');
	Route::get('center-certificate/{id}', [CenterController::class, 'center_certificate'])->name('view_center_certificate');

	// Student
	Route::get('add-new-student', [StudentController::class, 'add_student'])->name('add_new_student');
	Route::post('add-new-student', [StudentController::class, 'add_student_now'])->name('add_new_student');
	Route::get('student-list', [StudentController::class, 'student_list'])->name('student_list');
	Route::get('add-student', [StudentController::class, 'add_student'])->name('add_student');
	Route::post('add-student', [StudentController::class, 'add_student_now'])->name('add_student');
	Route::get('edit-student/{id}', [StudentController::class, 'edit_student'])->name('edit_student');
	Route::post('edit-student/{id}', [StudentController::class, 'update_student'])->name('edit_student');
	Route::get('delete-student/{id}', [StudentController::class, 'delete_student'])->name('delete_student');
	Route::get('student-status-update', [StudentController::class, 'student_status_updated'])->name('student_status_updated');
	Route::get('print-student-application/{id}', [StudentController::class, 'student_application'])->name('student_application_view');
	Route::get('get-reg-no', [StudentController::class, 'get_reg_no'])->name('get_reg_no');

	// Course
	Route::get('course-list', [CourseController::class, 'course_list'])->name('course_list');
	Route::get('add-course', [CourseController::class, 'add_course'])->name('add_course');
	Route::post('add-course', [CourseController::class, 'add_course_now'])->name('add_course');
	Route::get('edit-course/{id}', [CourseController::class, 'edit_course'])->name('edit_course');
	Route::post('edit-course/{id}', [CourseController::class, 'update_course'])->name('edit_course');
	Route::get('delete-course/{id}', [CourseController::class, 'delete_course'])->name('delete_course');

	// Upadate Student Registration Fees
	Route::get('set-student-registration-fees', [StudentController::class, 'set_reg_fee'])->name('set_reg_fee');
	Route::post('set-student-registration-fees', [StudentController::class, 'update_reg_fee'])->name('set_reg_fee');

	// Center Transaction
	Route::get('center-transaction-history', [CenterPaymentController::class, 'center_transaction_payment'])->name('center_transaction_payment');

	//center Payment History
	Route::get('center-payment-history', [CenterPaymentController::class, 'center_payment'])->name('center_payment');

	// Income/Expense
	Route::get('income-and-expense', [IncomeExpenseController::class, 'income_expense'])->name('admin_income_expense');
	Route::post('income-and-expense', [IncomeExpenseController::class, 'income_expense_create'])->name('admin_income_expense_create');
	Route::get('income-and-expense-delete/{id}', [IncomeExpenseController::class, 'income_expense_delete'])->name('admin_income_expense_delete');

});