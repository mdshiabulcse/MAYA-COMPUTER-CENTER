<?php

namespace App\Http\Controllers\center;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GenerateAdmitController extends Controller
{
    public function generate_admit_card(){
    	return view('center.admit_card.create');
    }

    public function admit_card_list(){
    	return view('center.admit_card.index');
    }
}
