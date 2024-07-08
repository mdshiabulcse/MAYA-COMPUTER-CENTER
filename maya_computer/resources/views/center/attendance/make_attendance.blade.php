@extends('center.layouts.master')
@section('title', 'Mark Attendance')
@push('custom-css')
<style type="text/css">
	
</style>
@endpush
@section('content')
<div class="row">
	<div class="col-12">
		<div class="page-title-box d-sm-flex align-items-center justify-content-between">
			<h4 class="mb-sm-0 font-size-18">Make Attendance
			<button class='btn btn-primary btn-sm' onClick ='exportxls()'> Export </button></h4>
			<form action ='' method='get'>
				<div class="page-title-right">
					<select name ='batch_id' >
						<option>--Select Btach--</option>
						@foreach($batch as $data)
						<option value="{{ $data->ab_id }}" @if(request()->get('batch_id') == $data->ab_id) selected @endif>{{ $data->ab_name }}</option>
						@endforeach
					</select>
					<input type='date' class='h6' name='att_date' onblur='submit()'>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- end page title -->
@php
use Carbon\Carbon;
$date = Carbon::parse(request()->get('att_date'));
$formattedDate = $date->format('d-M-Y (l)');
@endphp
@if(request()->get('batch_id') && request()->get('att_date'))
<form method="post">
			@csrf
<div class="card mb-4">
	<div class="card-header bg-secondary text-white font-weight-bold">
		Attendance of {{ $formattedDate }} </b>
		
			<button type="submit" class="btn btn-success" style="display: flex; margin:10px">Submit Attendance</button>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table id="datatable-buttons" class="table table-bordered table-sm table-striped w-100">
					<thead>
						<tr class="table_main_row">
							
							<th>Roll No</th>
							<th>Student Name</th>
							@php
								$today = today();
								$dates = [];
								
								for ($i = 1; $i < $today->daysInMonth + 1; ++$i) {
									$dates[] = \Carbon\Carbon::createFromDate($today->year, $today->month, $i)->format('Y-m-d');
								}
							@endphp
							@foreach ($dates as $date)
								<th>
									{{ $date }}
								</th>
							@endforeach
						</tr>
					</thead>
					<tbody>
						
						
						
						@php
							$i=1;
						@endphp
						@foreach($student as $stu)
							<input type="hidden" name="student_id" value="{{ $stu->sl_id }}">
							<tr>
								<td>{{ $stu->sl_reg_no }}</td>
								<td>{{ $stu->sl_name }}</td>
								@for ($i = 1; $i < $today->daysInMonth + 1; ++$i)
									@php
										$date_picker = \Carbon\Carbon::createFromDate($today->year, $today->month, $i)->format('Y-m-d');
										
										$check_attd = \App\Models\center\MarkAttendance::query()
										->where('am_FK_of_student_id', $stu->sl_id)
										->where('am_date', $date_picker)
										->first();
									@endphp
									<td>
										
										<div class="form-check form-check-inline">
											<input class="form-check-input" id="check_box"
											name="attd[{{ $stu->sl_id }}]" type="checkbox" @if (isset($check_attd))  checked @endif
											id="inlineCheckbox1" value="1">
										</div>
									</td>
								@endfor
							</tr>
						@endforeach
						
					</tbody>
				</table>
			
		</div>
		
	</div>
</div>
</form>
@endif
@endsection
@push('custom-js')
<script type="text/javascript">
	
</script>
@endpush