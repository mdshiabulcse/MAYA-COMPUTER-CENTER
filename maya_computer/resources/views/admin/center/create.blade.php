@extends('admin.layouts.master')
@section('title', 'Add Center')
@push('custom-css')
<style type="text/css">
		
</style>
@endpush
@section('content')
<!-- start page title -->
<div class="row">
	<div class="col-12">
		<div class="page-title-box d-sm-flex align-items-center justify-content-between">
			<h4 class="mb-sm-0 font-size-18">Center</h4>
		</div>
	</div>
</div>
<!-- end page title -->
<div class="row">
	<div class="col-lg-12">
		<form id='update_frm' method="post" enctype="multipart/form-data">
			@csrf
			<div class="card">
				<div class="card-header bg-secondary text-white font-weight-bold">
					Center Registration
					<span class='float-right' style='float:right'>
						<a href="{{ route('center_list') }}">  <button class="btn btn-dark btn-sm" > View All </button></a>
					<button class="btn btn-success btn-sm" id="update_btn" accesskey="s"> SAVE </button>                                    </span>
				</div>
				<div class="card-body"> 
					<div class='row'>
						{{-- <div class="col-md-4 mb-3">
							<div class="form-group mb-3">
								<label>Center Code</label>
								<input required class="form-control" placeholder="Center Code"  type='number' name='center_code'>
							</div>
						</div> --}}
						<div class="col-md-4 mb-3">
							<div class="form-group mb-3">
								<label>Center Name</label>
								<input required class="form-control" placeholder="Center Name" type='text' name='center_name'>
							</div>
						</div>
						<div class="col-md-4 mb-3">
							<div class="form-group mb-3">
								<label>Center Director Name</label>
								<input required class="form-control" placeholder="Director Name"  type='text' name='director_name'>
							</div>
						</div>
						<div class="col-md-4 mb-3">
							<div class="form-group mb-3">
								<label>Center Address</label>
								<input required class="form-control" placeholder="Address"  type='text' name='center_address'>
							</div>
						</div>
						<div class="col-md-4 mb-3">
							<div class="form-group mb-3">
								<label>Center Email</label>
								<input required class="form-control" placeholder="Email"  type='email' name='center_email'>
							</div>
						</div>
						<div class="col-md-4 mb-3">
							<div class="form-group mb-3">
								<label>Center Mobile</label>
								<input required class="form-control" placeholder="Mobile"  type='number' name='center_mobile'>
							</div>
						</div>
						<div class="col-md-4 mb-3">
							<div class="form-group mb-3">
								<label>Photo</label>
								<input required class="form-control"  type='file' name='photo'>
							</div>
						</div>
					</div>
					<div class="row">
					    <div class="col-lg-12">
					        <h5 style="background: #74788d;padding: 9px;color: #fff;font-size: 14px;">Center Document</h5>
					    </div>
					</div>
					<div class="row">
					    <div class="col-lg-4 mb-3">
					        <div class="form-group mb-3">
    							<label>Center Stamp</label>
    							<input required class="form-control"  type='file' name='center_stamp'>
						    </div>
					    </div>
					    <div class="col-lg-4 mb-3">
					        <div class="form-group mb-3">
    							<label>Center Signature</label>
    							<input required class="form-control"  type='file' name='center_signature'>
						    </div>
					    </div>
					    <div class="col-lg-4 mb-3">
					        <div class="form-group mb-3">
    							<label>Director Adhar Card</label>
    							<input required class="form-control"  type='file' name='director_adhar'>
						    </div>
					    </div>
					    <div class="col-lg-4 mb-3">
					        <div class="form-group mb-3">
    							<label>Director PAN Card</label>
    							<input required class="form-control"  type='file' name='director_pan'>
						    </div>
					    </div>
					    <div class="col-lg-4 mb-3">
					        <div class="form-group mb-3">
    							<label>Director Education</label>
    							<input required class="form-control" placeholder="Director Education"  type='text' name='director_education'>
						    </div>
					    </div>
					</div>
				</div>
				<!-- end select2 -->
			</div>
		</form>
			<!-- <div class="card-footer bg-white">
					<hr>
					
					<hr>
			</div> -->
		</div>
		<!-- end row -->
		</div> <!-- container-fluid -->
	</div>
	<!-- End Page-content -->
</div>
@endsection
@push('custom-js')
@endpush