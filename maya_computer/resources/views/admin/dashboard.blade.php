@extends('admin.layouts.master')
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
						<img src="backend/assets/images/profile-img.png" alt="" class="img-fluid">
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
						<h5 class="font-size-15 text-truncate">{{ Auth::guard('admin')->user()->al_name }}</h5>
						<p class="text-muted mb-0 text-truncate">Super Admin</p>
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
			<div class="col-md-4">
				<div class="card mini-stats-wid" style="background: #50d5ff;">
					<div class="card-body">
						<div class="d-flex">
							<div class="flex-grow-1">
								<p class="text-muted fw-medium">Total User</p>
								<h4 class="mb-0">1</h4>
							</div>
							<div class="flex-shrink-0 align-self-center">
								<div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
									<span class="avatar-title">
										<i class="bx bx-copy-alt font-size-24">2</i>
									</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card mini-stats-wid" style="background: #acc1ef;">
					<div class="card-body">
						<div class="d-flex">
							<div class="flex-grow-1">
								<p class="text-muted fw-medium">Total Volunteer</p>
								<h4 class="mb-0">7</h4>
							</div>
							<div class="flex-shrink-0 align-self-center ">
								<div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
									<span class="avatar-title rounded-circle bg-primary">
										<i class="bx bx-archive-in font-size-24"></i>
									</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card mini-stats-wid" style="background: #00faff;">
					<div class="card-body">
						<div class="d-flex">
							<div class="flex-grow-1">
								<p class="text-muted fw-medium">Gallery</p>
								<h4 class="mb-0">10</h4>
							</div>
							<div class="flex-shrink-0 align-self-center">
								<div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
									<span class="avatar-title rounded-circle bg-primary">
										<i class="bx bx-purchase-tag-alt font-size-24"></i>
									</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card mini-stats-wid" style="background: #b3e548;">
					<div class="card-body">
						<div class="d-flex">
							<div class="flex-grow-1">
								<p class="text-muted fw-medium">Total Cause</p>
								<h4 class="mb-0">4</h4>
							</div>
							<div class="flex-shrink-0 align-self-center">
								<div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
									<span class="avatar-title rounded-circle bg-primary">
										<i class="bx bx-purchase-tag-alt font-size-24"></i>
									</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card mini-stats-wid" style="background: #ff8989;">
					<div class="card-body">
						<div class="d-flex">
							<div class="flex-grow-1">
								<p class="text-muted fw-medium">Total Blog</p>
								<h4 class="mb-0">8</h4>
							</div>
							<div class="flex-shrink-0 align-self-center">
								<div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
									<span class="avatar-title rounded-circle bg-primary">
										<i class="bx bx-purchase-tag-alt font-size-24"></i>
									</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card mini-stats-wid" style="background: #fff;">
					<div class="card-body">
						<div class="d-flex">
							<div class="flex-grow-1">
								<p class="text-muted fw-medium">Total Contact</p>
								<h4 class="mb-0">0</h4>
							</div>
							<div class="flex-shrink-0 align-self-center">
								<div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
									<span class="avatar-title rounded-circle bg-primary">
										<i class="bx bx-purchase-tag-alt font-size-24"></i>
									</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- end row -->
@endsection