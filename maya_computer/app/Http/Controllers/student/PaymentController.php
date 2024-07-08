<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function view_payment(){
    	
    	return view('student.view_payment_history');
    }
}
