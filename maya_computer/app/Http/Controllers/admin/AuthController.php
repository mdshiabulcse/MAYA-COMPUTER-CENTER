<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Admin;
use Auth;
use Session;
class AuthController extends Controller
{
    public function admin_login(){
    	if(auth::guard('admin')->check()):
    		return redirect('admin/dashboard');
    	endif;
    	return view('admin.auth.login');
    }

    public function admin_login_now(Request $request){
    	if (Auth::guard('admin')->attempt(['al_email'=>$request->email,'password'=>$request->password])) {
    	   return redirect('admin/dashboard');
    	}
    	Session::flash('error', 'Invalid credential');
    	return redirect()->back();
    }

    public function admin_logout(){
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }

    public function admin_dashboard(){
    	return view('admin.dashboard');
    }
}
