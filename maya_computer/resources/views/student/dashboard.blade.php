@extends('student.layouts.master')
@section('title', 'Student Dashboard')
@push('custom-css')
<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');
*{
margin: 0;
padding: 0;
box-sizing: border-box;
font-family: 'Poppins', sans-serif;
}
body{
background-color: #eee;
}
#student_view img{
height: 150px;
width: 150px;
border: 8px solid #eee;
position: absolute;
left: 50%;
top: 0;
transform: translate(-50%,-50%);
}
.card{
position:relative;
width: 100%;
border-radius: 5px;
border: none;

}
.name{
font-size: 20px;
margin-bottom: 6px;
padding-top: 90px;
}
.job{
color: #25fa25;
font-size: 12px;
font-weight: 700;
margin-bottom: 8px;
}
.container .card .icons .icon {
font-size: 14px;
width: 30px;
height: 30px;
color: white;
background-color: #fa2525;
border-radius: 50%;
display: flex;
justify-content: center;
align-items: center;
cursor: pointer;
}
.dis{
color: #7e7c7c;
line-height: 2;
}
.container .card:hover .icons .icon {
background-color: #f06d6d;
}
.container .card:hover .text-center{
background-color:#fa2525;
color: white;
}
.container .card:hover .job,.container .card:hover .name{
color: white;
}
.container .card:hover .dis{
color: #c4c4c4;
}
.container .card .icons .icon:hover{
background-color: rgb(235, 123, 103);
}
.mt-80{
margin-top: 80px;
}
td{
padding:4px;
}
tr:nth-child(even) {background-color: #f2f2f2;}
</style>
@endpush
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
<div class="container-fluid">
	<h3 align='center'> Welcome to Maya Computer Center</h3>
	
	<div class="card mb-4">
		<div class="card-body" id="student_view">
			
			<div class='row'>
				
				<div class="col-lg-4  col-md-6 col-sm-6 mt-80">
					<div class="card  d-flex align-items-center justify-content-center text-light" style='background:#550874;'>
						<div class="w-100"><img src="{{ asset('center/student_doc/').'/'.$data->sl_photo }}" alt="" class="rounded-circle" ></div>
						<div class="text-center ">
							<p class="name">{{ $data->sl_name }}</p>
							
							<p>{{ $data->sl_reg_no }}</p>
							
							<ul class="d-flex align-items-center justify-content-center list-unstyled icons">
								<li class="icon "><span class="fa fa-birthday-cake"></span></li>
								<li class="icon mx-2">
								13-Feb-1997                            </li>
								
							</ul>
							<p class="dis pb-4 text-light" >
								
								{{ $data->c_short_name }}<br>
								
								{{ $data->c_full_name }}
							</p>
						</div>
					</div>
				</div>
				<div class="col-lg-8  col-md-6 col-sm-6 mt-80">
					
					<table width="100%" cellpadding='4px' style='border:solid 1px #d2d2d2;' >
						
						<tr>
							<td> <label> Mother's Name </label> </td> <td> : </td>
							<td> {{ $data->sl_mother_name }} </td>
							
						</tr>
						
						<tr>
							<td> <label> Father's Name </label> </td> <td> : </td>
							<td> {{ $data->sl_father_name }} </td>
							
						</tr>
						
						
						<tr>
							<td> <label> Course Title</label> </td> <td> : </td>
							<td> {{ $data->c_full_name }}
								( {{ $data->c_short_name }} )
							</td>
						</tr>
						<tr>
							<td> <label> Course Duration</label> </td> <td> : </td>
							<td> {{ $data->c_duration }} Months </td>
						</tr>
						
						<tr>
							<td width='190'> <label> Center Code </label> </td> <td> : </td>
							<td> {{ $data->cl_code }} </td>
						</tr>
						<tr>
							<td width='190'> <label> Center Name </label> </td> <td> : </td>
							<td> {{ $data->cl_center_name }}     </td>
						</tr>
						<tr>
							<td width='190'> <label> Center Address </label> </td> <td> : </td>
							<td> {{ $data->cl_center_address }} </td>
							
						</tr>
						
						<tr>
							<td width='190'> <label> Contact Number </label> </td> <td> : </td>
							<td> 8825148127 </td>
							
						</tr>
						
						
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- end row -->
</div> <!-- container-fluid -->
<!-- end row -->
@endsection