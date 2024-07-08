<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<style type="text/css">
		body {
					background-color: transparent;
					font-family:'verdana';
				}
		.id-card-holder {
					width: 225px;
				    padding: 4px;
				    margin: 0 auto;
				    background-color: #1f1f1f;
				    border-radius: 5px;
				    position: relative;
				}
		.id-card-holder:after {
				    content: '';
				    width: 7px;
				    display: block;
				    background-color: #0a0a0a;
				    height: 100px;
				    position: absolute;
				    top: 105px;
				    border-radius: 0 5px 5px 0;
				}
		.id-card-holder:before {
				    content: '';
				    width: 7px;
				    display: block;
				    background-color: #0a0a0a;
				    height: 100px;
				    position: absolute;
				    top: 105px;
				    left: 222px;
				    border-radius: 5px 0 0 5px;
				}
		.id-card {
					
					background-color: #fff;
					padding: 10px;
					border-radius: 10px;
					text-align: center;
					box-shadow: 0 0 1.5px 0px #b9b9b9;
				}
		.id-card img {
					margin: 0 auto;
				}
		.header img {
					width: 100px;
		    		margin-top: 15px;
				}
		.photo img {
					width: 80px;
		    		margin-top: 15px;
		    		border: 4px solid #cbc8c8;
                    border-radius: 3px;
				}
		h2 {
					font-size: 15px;
					margin: 5px 0;
				}
		h3 {
					font-size: 12px;
					margin: 2.5px 0;
					font-weight: 300;
				}
		.qr-code img {
					width: 50px;
				}
		p {
					font-size: 5px;
					margin: 2px;
				}
		.id-card-hook {
					background-color: black;
				    width: 70px;
				    margin: 0 auto;
				    height: 15px;
				    border-radius: 5px 5px 0 0;
				}
		.id-card-hook:after {
					content: '';
				    background-color: white;
				    width: 47px;
				    height: 6px;
				    display: block;
				    margin: 0px auto;
				    position: relative;
				    top: 6px;
				    border-radius: 4px;
				}
		.id-card-tag-strip {
					width: 45px;
				    height: 40px;
				    background-color: #d9300f;
				    margin: 0 auto;
				    border-radius: 5px;
				    position: relative;
				    top: 9px;
				    z-index: 1;
				    border: 1px solid #a11a00;
				}
		.id-card-tag-strip:after {
					content: '';
				    display: block;
				    width: 100%;
				    height: 1px;
				    background-color: #a11a00;
				    position: relative;
				    top: 10px;
				}
		.id-card-tag {
					width: 0;
					height: 0;
					border-left: 100px solid transparent;
					border-right: 100px solid transparent;
					border-top: 100px solid #d9300f;
					margin: -10px auto -30px auto;
		      
				}
		.id-card-tag:after {
					content: '';
				    display: block;
				    width: 0;
				    height: 0;
				    border-left: 50px solid transparent;
				    border-right: 50px solid transparent;
				    border-top: 100px solid white;
				    margin: -10px auto -30px auto;
				    position: relative;
				    top: -130px;
				    left: -50px;
				}
	</style>
</head>
<body>
	<div class="id-card-tag"></div>
	<div class="id-card-tag-strip"></div>
	<div class="id-card-hook"></div>
	<div class="id-card-holder">
		<div class="id-card">
			<div class="header">
				<img src="https://mayacomputercenter.in/images/header.png">
			</div>
			<div class="photo">
				<img src="{{ asset('center/student_doc/').'/'.$data->sl_photo }}">
			</div>
			<h2>{{ $data->sl_name }}</h2>
			<div class="qr-code">
				
			</div>
			<h3>Student Reg.No</h3>
      <h3>{{ $data->sl_reg_no }}</h3>
      <h3>Course - {{ $data->c_short_name }}</h3>
			<hr>
			<p><strong>{{ $data->cl_center_name }}</strong><p>
			<p>{{ $data->cl_center_address }} </p>
			{{-- <p>District Alwar, Rajasthan <strong>301705</strong></p> --}}
			<p>Ph: {{ $data->cl_mobile }}</p>

		</div>
	</div>
	<center><input type='button' value=' PRINT ' onClick='this.style.display="none";window.print();' ></center>
</body>
</html>