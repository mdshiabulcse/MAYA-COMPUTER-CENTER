@extends('center.layouts.master')
@section('title', 'Dashboard')
@section('content')
<!-- start page title -->
<div class="row">
	<div class="col-12">
		<div class="page-title-box d-sm-flex align-items-center justify-content-between">
			<h4 class="mb-sm-0 font-size-18">Dashboard</h4>
		</div>
	</div>
</div>
<!-- end page title -->
<div class="row">
	<div class="col-xl-4">
		<div class="card overflow-hidden" style="height: 248px;">
			<div class="bg-primary bg-soft">
				<div class="row">
					<div class="col-7">
						<div class="text-primary p-3">
							<h5 class="text-primary">Welcome Back !</h5>
							<p>Your Profile</p>
						</div>
					</div>
					<div class="col-5 align-self-end">
						<img src="{{ asset('backend/assets/images/profile-img.png') }}" alt="" class="img-fluid">
					</div>
				</div>
			</div>
			<div class="card-body pt-0">
				<div class="row">
					<div class="col-sm-4">
						<div class="avatar-md profile-user-wid mb-4">
							{{-- @if($data->al_photo)
							<img src="{{ asset('admin/profile/').'/'.$data->al_photo }}" alt="" class="img-thumbnail rounded-circle">
							@else
							<img src="{{ asset('backend/assets/images/users/avatar-1.jpg') }}" alt="" class="img-thumbnail rounded-circle">
							@endif --}}
						</div>
						<h5 class="font-size-15 text-truncate">{{ Auth::guard('center')->user()->cl_name }}</h5>
						<p class="text-muted mb-0 text-truncate">{{ Auth::guard('center')->user()->cl_director_name }}</p>
					</div>
					<div class="col-sm-8">
						<div class="pt-4">
							<div class="mt-4">
								<a href="" class="btn btn-primary waves-effect waves-light btn-sm">View Profile <i class="mdi mdi-arrow-right ms-1"></i></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xl-8">
		<div class="row">
			<div class="col-md-6">
				<div class="card mini-stats-wid">
					<div class="card-body">
						<div class="d-flex">
							<div class="flex-grow-1">
								<p class="text-muted fw-medium">ALL STUDENT'S</p>
								<h4 class="mb-0">{{$all_student}}</h4>
							</div>
							<div class="flex-shrink-0 align-self-center">
								<div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
									<span class="avatar-title">
										<i class="fa fa-users  font-size-24"></i>
									</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="card mini-stats-wid">
					<div class="card-body">
						<div class="d-flex">
							<div class="flex-grow-1">
								<p class="text-muted fw-medium">PENDING</p>
								<h4 class="mb-0">{{$pending_student}}</h4>
							</div>
							<div class="flex-shrink-0 align-self-center">
								<div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
									<span class="avatar-title">
										<i class="fa fa-users  font-size-24"></i>
									</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="card mini-stats-wid">
					<div class="card-body">
						<div class="d-flex">
							<div class="flex-grow-1">
								<p class="text-muted fw-medium">VERIFIED</p>
								<h4 class="mb-0">{{$verify_student}}</h4>
							</div>
							<div class="flex-shrink-0 align-self-center">
								<div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
									<span class="avatar-title">
										<i class="fa fa-users  font-size-24"></i>
									</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="card mini-stats-wid">
					<div class="card-body">
						<div class="d-flex">
							<div class="flex-grow-1">
								<p class="text-muted fw-medium">DISPATCHED</p>
								<h4 class="mb-0">{{$dispatched_student}}</h4>
							</div>
							<div class="flex-shrink-0 align-self-center">
								<div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
									<span class="avatar-title">
										<i class="fa fa-users  font-size-24"></i>
									</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="card">
			<div class="card-body">
				<h4 class="card-title mb-4"> What's New</h4>
				<div class="card-body bg-primary bg-soft pt-2">
					
					
					
				</div>
				<div class="d-sm-flex flex-wrap">
					<h4 class="card-title mb-2 mt-2"> Institution Profile</h4>
				</div>
				
				<table class="table" width='100%'>
					
					<tr>
						<td width='160'> <label> Center Code </label> </td>
						<td> {{ $data->cl_code }} </td>
						
						<td rowspan='5'  style='vertical-align:middle;text-align:center;' width='180'>
							<img src="{{ asset('admin/center_image/').'/'.$data->cl_photo }}" alt ='Image Not Available' width ='110' height='140' />
						</td>
						
					</tr>
					
					<tr>
						<td> <label> Center Name </label> </td>
						<td> {{ $data->cl_center_name }}     </td>
					</tr>
					<tr>
						<td> <label> Director's Name  </label> </td>
						<td> {{ $data->cl_director_name }}     </td>
					</tr>
					<tr>
						<td> <label> Address </label> </td>
						<td> {{ $data->cl_center_address }} </td>
					</tr>
					
					<tr>
						
						<td> <label> Email ID </label> </td>
						<td> {{ $data->cl_email }}</td>
						
					</tr>
					<tr>
						
						<td> <label> Mobile </label> </td>
						<td> {{ $data->cl_mobile }} </td>
						<td ></td>
					</tr>
					
					
				</table>
				
				
			</div>
		</div>
	</div>
</div>
<!-- end row -->
</div>
</div>
<!-- end row -->
@endsection