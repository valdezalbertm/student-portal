<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

	@yield('title')

    <!-- favicon -->
    <link rel="shortcut icon" href="{{ URL::asset('/public/favicon.ico'); }}">

    <!-- Bootstrap core CSS -->
    <link href="{{ URL::asset('/public/css/bootstrap.css') }}" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href="{{ URL::asset('/public/css/sb-admin.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ URL::asset('/public/font-awesome/css/font-awesome.min.css'); }}">
		<link rel="stylesheet" href="{{ URL::asset('assets/css/administrator/custom.css') }}">
</head>
<body class="">
	<div id="wrapper">

      	<!-- Sidebar -->
      	@include('administrator.sidebar')

      	<div id="page-wrapper">
			<div class="">
				@yield('data.info.title')
			</div>
			<div class="">
				<div class="">
				@if(Session::get('class'))
				    <div class="{{Session::get('class')}}">
				        <button class="close" data-dismiss="alert" type="button">&times;</button>
				         {{Session::get('message')}}
				    </div>
				@endif
			    
				</div>
			</div>
			<div class="">
				@yield('data.title')
			</div>
			<div class="">
				@yield('data')
			</div>
		</div>
	</div>
</body>
<footer>
    <!-- JavaScript -->
    <script src="{{ URL::asset('/public/js/jquery-1.10.2.js'); }}"></script>
    <script src="{{ URL::asset('/public/js/bootstrap.js'); }}"></script>
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
	
	@yield('footer')
</footer>
</html>