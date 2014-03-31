<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" sizes="144x144" href="{{ URL::asset('assets/ico/favicon.png') }}">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	@yield('head')
</head>
<body>
	@yield('body')
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