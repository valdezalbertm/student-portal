<html>
	<head>
	    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <meta name="description" content="">
	    <meta name="author" content="">

	    <link rel="shortcut icon" href="{{ URL::asset('assets/img/sjaod-logo.ico') }}">

		<!-- BOOTSTRAP CORE CSS -->
		<link rel="stylesheet" href="{{ URL::asset('assets/css/bootstrap.min.css') }}">
		
		<!-- ADD CUSTOM CSS HERE -->
		<link rel="stylesheet" href="{{ URL::asset('assets/css/custom.css') }}">
		<link rel="stylesheet" href="{{ URL::asset('assets/font-awesome/css/font-awesome.min.css') }}">
		<link rel="stylesheet" href="{{ URL::asset('assets/css/blueimp-gallery.min.css') }}">

		<style type="text/css">
			@media print {
				body * {
					visibility: hidden;
				}
				#section-to-print, #section-to-print * {
					visibility: visible;
				}
				#section-to-print {
					position: absolute;
					left: 0;
					top: 0;
				}
			}
		</style>

		<title>Validation - St. Jude Academy Student Portal</title>
	</head>
    <body>
		<div class="container result-form">
			<div class="result-nav">
				<h2 class="pull-left"><a href="{{ URL::to('/') }}"><i class="fa fa-home"></i> HOME</a></h2>

				<h2 class="pull-right"><a href="#" onclick="print_page()"><i class="fa fa-print"></i> PRINT VALIDATION FORM</a></h2>
			</div>

			<div class="alert alert-info">
				<i class="fa fa-warning"></i> NOTE: PLEASE PRINT THIS EXAMINATION VALIDATION FORM AND PASS IT TO THE GUIDANCE OFFICE INCLUDING OTHER REQUIREMENT (SEE BELOW) ON YOUR SELECTED SCHEDULE TO PROCEED ON EXAMINATION.
				<ul>
					<li>BIRTH CERTIFICATE</li>
					<li>2X2 PICTURE</li>
					<li>REPORT CARD OF PREVIOUS SCHOOL</li>
					<li>CERTIFICATE OF GOOD MORAL CHARACTER</li>
				</ul>
			</div>
			
			<div id="section-to-print">
				<h2>EXAMINATION VALIDATION FORM</h2>
				
				<p><i class='fa fa-user'></i> <b>STUDENT NAME:</b> {{ $validation_info->$user->last_name.', '.$validation_info->$user->first_name.' '.$validation_info->$user->middle_name.'.' }}</p>
				<p><i class='fa fa-certificate'></i> <b>SCHOLARSHIP NAME:</b> {{ $validation_info->scholarship->name }}</p>
				<p><i class='fa fa-calendar'></i> <b>SY APPLIED:</b> {{ $validation_info->school_year }}</p>
				<p><i class='fa fa-lock'></i> <b>VALIDATION KEY:</b> {{ $validation_info->validation_key }}</p>
				<p><i class='fa fa-clock-o'></i> <b>EXAMINATION SCHEDULE:</b> {{ date('m/d/Y g:i A', strtotime($validation_info->quiz_schedule->from)). ' - ' .date('m/d/Y g:i A', strtotime($validation_info->quiz_schedule->to)) }}</p>
			</div>
		</div>
	    <script>
	      function print_page() {
	        window.print();
	      }
	    </script>
    </body>
</html>