<?php

namespace App\Http\Controllers\center;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\center\Center;
use Auth;
class ProfileController extends Controller
{
    public function profile_update(){
    	$data = Center::where('cl_id', Auth::guard('center')->user()->cl_id)->first();
    	return view('center.profile_update', compact('data'));
    }

    public function profile_update_now(Request $request){
    	$center = Center::where('cl_id', Auth::guard('center')->user()->cl_id)->first();

    	if($request->hasFile('center_photo')):
    	    $image = $request->file('center_photo');
    	    $file = time().'_'.$image->getClientOriginalName();
    	    $image->move('center/center_image', $file);
    	    $data['cl_photo'] = $file;
    	    $center_photo = $file;
    	else:
    		$center_photo = $center->cl_photo;
    	endif;

    	if($request->hasFile('center_logo')):
    	    $image = $request->file('center_logo');
    	    $file = time().'_'.$image->getClientOriginalName();
    	    $image->move('center/center_image', $file);
    	    $data['cl_logo'] = $file;
    	    $center_logo = $file;
    	else:
    		$center_logo = $center->cl_logo;
    	endif;

    	if($request->hasFile('center_authorized_signature')):
    	    $image = $request->file('center_authorized_signature');
    	    $file = time().'_'.$image->getClientOriginalName();
    	    $image->move('center/center_image', $file);
    	    $data['cl_authorized_signature'] = $file;
    	    $center_authorized_signature = $file;
    	else:
    		$center_authorized_signature = $center->cl_logo;
    	endif;

    	$data = [
    		'cl_code'					=> $request->center_code,
    		'cl_center_name'			=> $request->center_name,
    		'cl_director_name'			=> $request->director_name,
            'cl_center_address'         => $request->address,
    		'cl_cin_no'			        => $request->cin_no,
    		'cl_email'					=> $request->email,
    		'cl_mobile'					=> $request->mobile,
    		'cl_photo'					=> $center_photo,
    		'cl_logo'					=> $center_logo,
    		'cl_authorized_signature'	=> $center_authorized_signature,
    	];

    	$update = Center::where('cl_id', Auth::guard('center')->user()->cl_id)->update($data);

    	if($update):
    		return back()->with('success', 'Profile Updated Successfully!');
    	else:
    		return back()->with('success', 'Something Went Wrong!');
    	endif;
    }
}
