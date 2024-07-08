<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\center\Center; 
use Hash;
class CenterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function center_list()
    {
        $center['center'] = Center::where('cl_code','!=', '61123000')->get();
        return view('admin.center.index', $center);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add_center()
    {
        return view('admin.center.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add_center_now(Request $request)
    {
        $lastInvoice = Center::orderBy('cl_id', 'desc')->first();
        if (!$lastInvoice) {
            return '61123001'; // If no invoice exists yet, start with this number
        }

        // Increment the last invoice number by 1
        $lastInvoiceNumber = (int) substr($lastInvoice->cl_code, -2);
        $nextInvoiceNumber = '611230' . str_pad(($lastInvoiceNumber + 1), 2, '0', STR_PAD_LEFT);
        
        if($request->hasFile('photo')):
            $image = $request->file('photo');
            $file = time().'_'.$image->getClientOriginalName();
            $image->move('admin/center_document', $file);
            $data['cl_photo'] = $file;
            $photo = $file;
        endif;

        if($request->hasFile('center_stamp')):
            $image = $request->file('center_stamp');
            $file = time().'_'.$image->getClientOriginalName();
            $image->move('admin/center_document', $file);
            $data['cl_center_stamp'] = $file;
            $center_stamp = $file;
        endif;
        
        if($request->hasFile('center_signature')):
            $image = $request->file('center_signature');
            $file = time().'_'.$image->getClientOriginalName();
            $image->move('admin/center_document', $file);
            $data['cl_center_signature'] = $file;
            $center_signature = $file;
        endif;
        
        if($request->hasFile('director_adhar')):
            $image = $request->file('director_adhar');
            $file = time().'_'.$image->getClientOriginalName();
            $image->move('admin/center_document', $file);
            $data['cl_director_adhar'] = $file;
            $director_adhar = $file;
        endif;
        
        if($request->hasFile('director_pan')):
            $image = $request->file('director_pan');
            $file = time().'_'.$image->getClientOriginalName();
            $image->move('admin/center_document', $file);
            $data['cl_director_pan'] = $file;
            $director_pan = $file;
        endif;
        
        

        $data = [
            'cl_code'               => $nextInvoiceNumber,
            'cl_center_name'        => $request->center_name,
            'cl_director_name'      => $request->director_name,
            'cl_center_address'     => $request->center_address,
            'cl_name'               => $request->center_name,
            'cl_photo'              => $photo,
            'cl_center_stamp'       =>$center_stamp,
            'cl_center_signature'   =>$center_signature,
            'cl_director_adhar'     =>$director_adhar,
            'cl_director_pan'       =>$director_pan,
            'cl_director_education' => $request->director_education,
            'cl_mobile'             => $request->center_mobile,
            'password'             => Hash::make($request->center_mobile),
            'cl_email'              => $request->center_email,
        ];

        $insert = Center::create($data);
        if($insert):
            return back()->with('success', 'Center Added Successfully!');
        else:
            return back()->with('error', 'Center Deleted Successfully!');
        endif;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   
    public function edit_center($id)
    {
        $data = Center::where('cl_id',$id)->first();
        return view('admin.center.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_center(Request $request, $id)
    {
        $exist = Center::where('cl_id',$id)->first();
        if($request->hasFile('photo')):
            $image = $request->file('photo');
            $file = time().'_'.$image->getClientOriginalName();
            $destinationPath=public_path('admin/center_image');
            $image->move($destinationPath, $file);
            $data['cl_photo'] = $file;
            $photo = $file;
        else:
            $photo = $exist->cl_photo;
        endif;

        $data = [
            // 'cl_code'               => $nextInvoiceNumber,
            'cl_center_name'        => $request->center_name,
            'cl_director_name'      => $request->director_name,
            'cl_center_address'     => $request->center_address,
            'cl_name'               => $request->center_name,
            'cl_photo'              => $photo,
            'cl_mobile'             => $request->center_mobile,
            'cl_email'              => $request->center_email,
        ];

        $insert = Center::where('cl_id',$id)->update($data);
        if($insert):
            return back()->with('success', 'Center Updated Successfully!');
        else:
            return back()->with('error', 'Center Deleted Successfully!');
        endif;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete_center($id)
    {
        try {
            $data = Center::where('cl_id',$id)->delete();
            return back()->with('success', 'Center Deleted Successfully!');
        } catch (Exception $e) {
            return back()->with('error', 'Something Went Wrong!');
        }
    }
    
    public function center_status(Request $request){
        $center = Center::where('cl_code', $request->center_code)->update([
            'cl_account_status'     => $request->center_status
        ]);
        
        if($center):
            $data = [
                'msg'   => 'Center Status Updated Successfully!',
                'status'    => 1,
            ];
        else:
            $data = [
                'msg'   => 'Something Went Wrong!',
                'status'    => 0,
            ];
        endif;
        
        return response()->json($data);
    }
    
    public function center_certificate($id){
        $center = Center::where('cl_id',$id)->first();
        return view('admin.center.center_certificate', compact('center'));
    }
}
