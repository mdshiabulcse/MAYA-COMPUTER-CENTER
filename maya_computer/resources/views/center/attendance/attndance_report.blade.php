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
					 <select name='tbl_name' onChange='submit()' class='h6'>
					 	<option value=''> Select Month </option>
					 	<option value="jan_2014">Jan 2024</option>
					 	<option value="feb_2024">Feb 2024</option>
					 	<option value="mar_2024">Mar 2024</option>
					 	<option value="apr_2024">Apr 2024</option>
					 	<option value="may_2024">May 2024</option>
					 	<option value="jun_2024">Jun 2024</option>
					 	<option value="jul_2024">Jul 2024</option>
					 	<option value="aug_2024">Aug 2024</option>
					 	<option value="sep_2024">Sep 2024</option>
					 	<option value="oct_2024">Oct 2024</option>
					 	<option value="nov_2024">Nov 2024</option>
					 	<option value="dec_2024">Dec 2024</option>
					 </select>
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
{{-- @if(request()->get('batch_id') && request()->get('att_date')) --}}
<div class="card mb-4">
	<div class="card-header bg-secondary text-white font-weight-bold">
        Attendance of {{ $formattedDate }} </b>
         
    </div>
	<div class="card-body">
		<div class="table-responsive">
			<table id="datatable-buttons" class="table table-bordered table-sm table-striped w-100">
				<thead>
					<tr class="table_main_row">
						<th>Student Name</th>
						@php
                                $today = today();
                                $dates = [];
                                
                                for ($i = 1; $i < $today->daysInMonth + 1; ++$i) {
                                    $dates[] = \Carbon\Carbon::createFromDate($today->year, $today->month, $i)->format('Y-m-d');
                                }
                                
                            @endphp
                           @foreach ($dates as $date)
                            <th style="">
                            
                                
                                    {{ $date }}
                            @endforeach
                            
                        </th>
					</tr>
				</thead>
				<tbody>
					@foreach($attendanceReport as $student => $attendanceData)
			            <tr>
			                <td>{{ $student }}</td>
			                @foreach($dates as $date)
			                    <td>
			                    	{{ $attendanceData[$date] }}
			                    </td>
			                @endforeach
			            </tr>
			        @endforeach
				</tbody>
			</table>
			
		</div>
	</div>
</div>
{{-- @endif --}}
@endsection
@push('custom-js')
	<script type="text/javascript">
		// function mark_att(student_id,batch_id,att_date){
		// 	var mark_status = $('#mark_att_'+student_id).val();
		// 	$.ajax({
		// 		url: "{{ route('mark_attendance') }}",
		// 		type: "get",
		// 		data: {mark_status,student_id,batch_id,att_date},
		// 		dataType: "json",
		// 		success: function(response){
		// 			if(response.status == 1){
		// 				alert(response.msg);
		// 			}else{
		// 				alert(response.msg);
		// 			}
		// 		}
		// 	});
		// }
	</script>
@endpush