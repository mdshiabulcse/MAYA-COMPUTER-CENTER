<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use DB;
use Auth;
class indexController extends Controller
{
    public function index()
    {

        return view('frontend/index');
    }
}
