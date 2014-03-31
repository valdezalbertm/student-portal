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

		<title>St. Jude Academy Student Portal</title>
	</head>
    <body>
		<div class="navbar navbar-inverse navbar-fixed-top transparent-nav" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<a class="navbar-brand" href="#">SJAOD SCHOLARSHIP EXAMINATION</a>
				</div>
				<div class="navbar-right">
			      @if($time_limit != 0) 
			        {{ "<div id='timer'><h3><i class='fa fa-clock-o'></i> TIME LEFT : ".sprintf ('%02u', $timer['hours'])."<span class='seperator'>HOUR </span>".sprintf ('%02u', $timer['minutes'])."<span class='seperator'>MIN </span>".sprintf ('%02u', $timer['seconds'])."<span class='seperator'>SEC</span></h3></div>"}}
			      @endif
				</div>
			</div>
		</div>

        @yield('content')  

        <script src="{{ URL::asset('assets/js/jquery-1.10.2.min.js') }}"></script>
	    <script src="{{ URL::asset('assets/js/bootstrap.min.js') }}"></script>
	    <script src="{{ URL::asset('assets/js/jquery.carousel.fullscreen.js') }}"></script>
	    <script src="{{ URL::asset('assets/js/jquery.blueimp-gallery.min.js') }}"></script>
		<script>
			document.getElementById('links').onclick = function (event) {
			    event = event || window.event;
			    var target = event.target || event.srcElement,
			        link = target.src ? target.parentNode : target,
			        options = {index: link, event: event},
			        links = this.getElementsByTagName('a');
			    blueimp.Gallery(links, options);
			};

			$('#facebook').tooltip('hide')
			$('#twitter').tooltip('hide')
		</script>
		
    </body>
</html>