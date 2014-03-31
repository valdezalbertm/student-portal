<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

	@yield('title')

    <!-- favicon -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico'); }}">

    <!-- Bootstrap core CSS -->
    <link href="{{ URL::asset('/public/css/bootstrap.css'); }}" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href="{{ URL::asset('/public/css/sb-admin.css'); }}" rel="stylesheet">
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
				<div class="row">
				    <div class="col-lg-12">
				        <div class="panel panel-info">
				            <div class="panel-heading">
				                <div class="row">
				                    <div class="col-xs-1">
				                        <i class="fa fa-edit fa-5x hidden-phone"></i>
				                    </div>
				                    <div class="col-xs-11 text-right">
				                        <p class="announcement-heading">
				                            {{ $student->first_name }}, {{ $student->middle_name[0] }}. {{ $student->last_name }}
				                        </p>
				                        <p class="announcement-text">
				                            Student Number : {{ $student->student_number }}
				                        </p>
				                    </div>
				                </div>
				            </div>
						    <div class="panel-footer announcement-bottom">
						        <div class="row">
						        	<?php 
						        		$student_show = URL::route('stud.show', $student->id);
						        	?>
									<a href="{{$student_show}}">
							            <div class="col-xs-6">
				                  			View Full Info
							            </div>
							            <div class="col-xs-6 text-right">
							                <i class="fa fa-arrow-circle-right"></i>
							            </div>
									</a>
						        </div>
						    </div>
				        </div>
				        <?php  
				        	$btn_link_add	 = URL::route('administrator.student.scholarship.create', $student->id);
				        	$btn_disable_add = ($btn_link_add == Request::url()) ? 'disabled' : '' ; 

				        	$btn_link_view	 = URL::route('administrator.student.scholarship.index', $student->id);
				        	$btn_disable_view = ($btn_link_view == Request::url()) ? 'disabled' : '' ; 
				        ?>
						<a href="{{$btn_link_add}}" class="btn btn-danger {{$btn_disable_add}}" type="button">
			                <i class="fa fa-plus"></i>
						    Assign Scholarship
						</a>
						<a href="{{$btn_link_view}}" class="btn btn-default {{$btn_disable_view}}" type="button">
			                <i class="fa fa-list"></i>
						    View Scholarship List
						</a>
				    </div>

				</div>
				<br>
			</div>
			<div class="">
				@if(Session::get('class'))
				<div class="">
				    <div class="{{Session::get('class')}}">
				        <button class="close" data-dismiss="alert" type="button">&times;</button>
				         {{Session::get('message')}}
				    </div>
				</div>
				@endif
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