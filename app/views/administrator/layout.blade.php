<!DOCTYPE html>
<html lang="en">
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
		<link rel="stylesheet" href="{{ URL::asset('assets/font-awesome/css/font-awesome.min.css') }}">
		<link rel="stylesheet" href="{{ URL::asset('assets/css/administrator/sb-admin.css') }}">
		<link rel="stylesheet" href="{{ URL::asset('assets/css/administrator/custom.css') }}">

		<!-- PAGE SPECIFIC CSS -->
		<link rel="stylesheet" href="{{ URL::asset('assets/css/bootstrap-datetimepicker.min.css') }}">
		<!-- <link rel="stylesheet" href="http://cdn.oesmith.co.uk/morris-0.4.3.min.css"> -->

		<!-- JAVASCRIPT -->
		<script src="{{ URL::asset('assets/js/jquery-1.10.2.min.js') }}"></script>
		<script src="{{ URL::asset('assets/js/bootstrap.js') }}"></script>

		<!-- PAGE SPECIFIC PLUGINS -->
		<script src="{{ URL::asset('assets/js/tablesorter/jquery.tablesorter.js') }}"></script>
		<script src="{{ URL::asset('assets/js/tablesorter/tables.js') }}"></script>
		<script src="{{ URL::asset('assets/js/moment.min.js') }}"></script>
		<script src="{{ URL::asset('assets/js/bootstrap-datetimepicker.min.js') }}"></script>

		<title>Dashboard - SJAOD Admininstration</title>
	</head>
	<body>
    	@yield('content')  

		<!-- ADD CUSTOM SCRIPT HERE -->
		<script>
			$(function(){
				$('.side-nav .dropdown').on('show.bs.dropdown', function(e){
					$(this).find('.dropdown-menu').first().stop(true, true).slideDown();
				});

				$('.side-nav .dropdown').on('hide.bs.dropdown', function(e){
					$(this).find('.dropdown-menu').first().stop(true, true).slideUp();
				});

				$('.side-nav  .dropdown').hover(function() {
			  		$(this).find('.dropdown-menu').first().stop(true, true).delay().slideDown();
				}, function() {
			  		$(this).find('.dropdown-menu').first().stop(true, true).delay().slideUp()
				});

				$(".side-nav .active").closest(".dropdown").find(".dropdown-toggle").trigger("click"); 

				$(".side-nav .active").closest(".dropdown").find('.dropdown-toggle').addClass("open");
			});
		</script>
	</body>
</html>