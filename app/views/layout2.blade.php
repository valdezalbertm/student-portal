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
		<link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
		<link rel="stylesheet" href="{{ URL::asset('assets/font-awesome/css/font-awesome.min.css') }}">
		<link rel="stylesheet" href="{{ URL::asset('assets/css/blueimp-gallery.min.css') }}">
		<link rel="stylesheet" href="{{ URL::asset('assets/css/perfect-scrollbar.css') }}">

		<!-- ADD CUSTOM JS HERE -->

		<title>St. Jude Academy Student Portal</title>
	</head>
    <body>
		<div class="navbar navbar-inverse navbar-fixed-top transparent-nav" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<a class="navbar-brand" href="{{ URL::to('/'); }}">ST JUDE ACADEMY STUDENT PORTAL</a>
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<div style="height: 0.916667px;" class="navbar-collapse collapse">
					{{ Form::open(array('route' => 'admin.login', 'method' => 'POST', 'class' => 'navbar-form navbar-right', 'role' => 'form')) }}
						<div class="form-group">
							{{ Form::text('username', null, array('class' => 'form-control', 'placeholder' => 'USERNAME', 'required')) }}
						</div>
						<div class="form-group">
							{{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'PASSWORD', 'required')) }}
						</div>
						
						<div class="checkbox">
							<label>
				  				{{ Form::checkbox('remember', 'remember-me', ['class' => 'checkbox']) }} REMEMBER ME
							</label>
						</div>
						<button type="submit" class="btn btn-success">SIGN IN</button>
					{{ Form::close() }}
				</div>
			</div>
		</div>

        @yield('content')  
		<script src="{{ URL::asset('assets/js/jquery-1.10.2.min.js') }}"></script>
	    <script src="{{ URL::asset('assets/js/bootstrap.min.js') }}"></script>
	    <script src="{{ URL::asset('assets/js/jquery.carousel.fullscreen.js') }}"></script>
	    <script src="{{ URL::asset('assets/js/jquery.blueimp-gallery.min.js') }}"></script>
	    <script src="{{ URL::asset('assets/js/perfect-scrollbar/src/jquery.mousewheel.js') }}"></script>
	    <script src="{{ URL::asset('assets/js/perfect-scrollbar/src/perfect-scrollbar.js') }}"></script>
		<script>
			document.getElementById('links').onclick = function (event) {
			    event = event || window.event;
			    var target = event.target || event.srcElement,
			        link = target.src ? target.parentNode : target,
			        options = {index: link, event: event},
			        links = this.getElementsByTagName('a');
			    blueimp.Gallery(links, options);
			};

			$('#facebook').tooltip('hide');
			$('#twitter').tooltip('hide');
		</script>

		<script>
			$(document).ready(function ($) {
				"use strict";

				$('#student, #applicant').perfectScrollbar({
					suppressScrollX: true
				});
			});
		</script>
    </body>
</html>