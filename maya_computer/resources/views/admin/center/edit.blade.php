@extends('admin.layouts.master')
@section('title', 'Edit Center')
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
	<div class="col-lg-8">
		<form id='update_frm' method="post" enctype="multipart/form-data">
			@csrf
			<div class="card">
				<div class="card-header bg-secondary text-white font-weight-bold">
					Center Edit
					<span class='float-right' style='float:right'>
						<a href="{{ route('center_list') }}" >  View All</a>
					<button class="btn btn-success btn-sm" id="update_btn" accesskey="s"> SAVE </button>                                    </span>
				</div>
				<div class="card-body"> 
					<div class='row'>
						{{-- <div class="col-md-6 mb-3">
							<div class="form-group mb-3">
								<label>Center Code</label>
								<input required class="form-control" placeholder="Center Code"  type='number' value="{{ $data->cl_code }}" name='center_code'>
							</div>
						</div> --}}
						<div class="col-md-6 mb-3">
							<div class="form-group mb-3">
								<label>Center Name</label>
								<input required class="form-control" placeholder="Center Name" type='text' value="{{ $data->cl_center_name	 }}" name='center_name'>
							</div>
						</div>
						<div class="col-md-6 mb-3">
							<div class="form-group mb-3">
								<label>Center Director Name</label>
								<input required class="form-control" placeholder="Director Name" value="{{ $data->cl_director_name }}" type='text' name='director_name'>
							</div>
						</div>
						<div class="col-md-6 mb-3">
							<div class="form-group mb-3">
								<label>Center Address</label>
								<input required class="form-control" placeholder="Address"  type='text' value="{{ $data->cl_center_address }}" name='center_address'>
							</div>
						</div>
						<div class="col-md-6 mb-3">
							<div class="form-group mb-3">
								<label>Center Email</label>
								<input required class="form-control" placeholder="Email"  type='email' value="{{ $data->cl_email }}" name='center_email'>
							</div>
						</div>
						<div class="col-md-6 mb-3">
							<div class="form-group mb-3">
								<label>Center Mobile</label>
								<input required class="form-control" placeholder="Mobile"  type='number' value="{{ $data->cl_mobile }}" name='center_mobile'>
							</div>
						</div>
						<div class="col-md-12 mb-3">
							@if($data->cl_photo)
								<img style="width: 100px;height: 106px;border: 5px solid #eee;" src="{{ asset('admin/center_image/').'/'.$data->cl_photo }}">
							@endif
						</div>
						<div class="col-md-6 mb-3">
							<div class="form-group mb-3">
								<label>Photo</label>
								<input class="form-control"  type='file' name='photo'>
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