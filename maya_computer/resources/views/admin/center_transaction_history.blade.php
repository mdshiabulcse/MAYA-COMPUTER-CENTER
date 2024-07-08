@extends('admin.layouts.master')
@section('title', 'Center Transaction')
@push('custom-css')
<style type="text/css">
	
</style>
@endpush
@section('content')
<div class="row">
	<div class="col-12">
		<div class="page-title-box d-sm-flex align-items-center justify-content-between">
			<h4 class="mb-sm-0 font-size-18">Center Transaction</h4>
			<div class="page-title-right">
				
			</div>
		</div>
	</div>
</div>
<!-- end page title -->
<div class="card mb-4">
	<div class='card-header bg-secondary text-white font-weight-bold'>
		{{-- Set Fee For {{ $course_name->c_full_name }} --}}
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table id="datatable-buttons" class="table table-bordered table-sm table-striped w-100">
				<thead>
					<tr class="table_main_row">
						<th>#ID</th>
						<th>Txn Date</th>
						<th>Center Code</th>
						<th>Center Name</th>
						<th>Amount</th>
						<th>Description</th>
					</tr>
				</thead>
				<tbody>
					@php
						$i=1;
					@endphp
					@foreach($transaction as $data)
						<tr>
							<td>{{ $i++ }}</td>
							<td>{{ $data->created_at }}</td>
							<td>{{ $data->cl_code }}</td>
							<td>{{ $data->cl_center_name }}</td>
							<td>{{ $data->t_amount }} ₹</td>
							<td>Docs fee for {{ $data->t_student_reg_no }}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
			
		</div>
		
	</div>
</div>
@endsection
@push('custom-js')

@endpush