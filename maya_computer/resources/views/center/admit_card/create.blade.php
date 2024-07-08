@extends('center.layouts.master')
@section('title', 'Generate Admit Student')
@push('custom-css')
<style type="text/css">
		
</style>
@endpush
@section('content')
<!-- start page title -->
<div class="row">
	<div class="col-12">
		<div class="page-title-box d-sm-flex align-items-center justify-content-between">
			<h4 class="mb-sm-0 font-size-18">GENERATE ADMIT CARD</h4>
		</div>
	</div>
</div>
<!-- end page title -->
<div class="row">
         <div class="col-lg-12">
            <div class="card">
            <div class="card-header bg-warning">
                Admit Card Issue
            </div>
            <div class="card-body">
				<div class='row'>
				
					    
					    
				
					<div class='col-md-2'></div>
					<div class='col-md-4'>
					 <form action ='admit_card' method ='post' id='insert_frm'>
						<div class="form-group">
                          <label>Student Roll No(s) </label>  
							<textarea class="form-control" name='student_id' placeholder='911041010002,911041010006,910541010002'></textarea>
                        </div>
						
						<div class="form-group">
                          <label>Exam Date</label>   
							<input class="form-control" value='' name='exam_date' type='date' min=''>
                        </div>
						<div class="form-group">
                          <label>Exam Time</label>   
                            <input class="form-control" value='' name='exam_time' type='time' >
                        </div>
					</div>
					<div class='col-md-4'>
					    <div class="form-group">
                            <label class="control-label" >Select Set</label>
                            <select name ='set_id' class='form-select'>
                                                            </select>
                        </div>
                        
						<div class="form-group">
                            <label class="control-label" >Exam Venue</label>
                            <input type="text" class="form-control" name='exam_venue' required>
                        </div>
						
						<div class="form-group">
                            <label class="control-label" >Notice </label>
                            <input type="text" class="form-control" name='exam_notice' >
                        </div>
						
						
					</form>		
						<button class="btn btn-danger btn-block mt-2"  id='insert_btn' >Create Admit Card</button> 
					</div>
				</div>
		</div>
		</div>
		</div>
		</div>
@endsection
@push('custom-js')
@endpush