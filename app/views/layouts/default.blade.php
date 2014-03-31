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
    <link href="{{ asset('css/bootstrap.css'); }}" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href="{{ asset('css/sb-admin.css'); }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('font-awesome/css/font-awesome.min.css'); }}">
</head>
<body class="">
	<div id="wrapper">

      	<!-- Sidebar -->
		<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	        <!-- Brand and toggle get grouped for better mobile display -->
	        <div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="index.html">SB Admin</a>
	        </div>

	        <!-- Collect the nav links, forms, and other content for toggling -->
	        <div class="collapse navbar-collapse navbar-ex1-collapse">
	          	<ul class="nav navbar-nav side-nav">
		            <li><a href="index.html"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		            <li><a href="charts.html"><i class="fa fa-bar-chart-o"></i> Charts</a></li>
		            <li><a href="tables.html"><i class="fa fa-table"></i> Tables</a></li>
		            <li><a href="forms.html"><i class="fa fa-edit"></i> Forms</a></li>
		            <li><a href="typography.html"><i class="fa fa-font"></i> Typography</a></li>
		            <li><a href="bootstrap-elements.html"><i class="fa fa-desktop"></i> Bootstrap Elements</a></li>
		            <li><a href="bootstrap-grid.html"><i class="fa fa-wrench"></i> Bootstrap Grid</a></li>
		            <li class="active"><a href="blank-page.html"><i class="fa fa-file"></i> Blank Page</a></li>
		            <li class="dropdown">
		              	<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i> Dropdown <b class="caret"></b></a>
		              	<ul class="dropdown-menu">
			                <li><a href="#">Dropdown Item</a></li>
			                <li><a href="#">Another Item</a></li>
			                <li><a href="#">Third Item</a></li>
			                <li><a href="#">Last Item</a></li>
		              	</ul>
		            </li>
	          	</ul>

	          	<ul class="nav navbar-nav navbar-right navbar-user">
	            	<li class="dropdown messages-dropdown">
	              		<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> Messages <span class="badge">7</span> <b class="caret"></b></a>
		            	<ul class="dropdown-menu">
			                <li class="dropdown-header">7 New Messages</li>
			                <li class="message-preview">
			                  	<a href="#">
				                    <span class="avatar"><img src="http://placehold.it/50x50"></span>
				                    <span class="name">John Smith:</span>
				                    <span class="message">Hey there, I wanted to ask you something...</span>
				                    <span class="time"><i class="fa fa-clock-o"></i> 4:34 PM</span>
			                  	</a>
			                </li>
			                <li class="divider"></li>
			                <li class="message-preview">
			                  	<a href="#">
				                    <span class="avatar"><img src="http://placehold.it/50x50"></span>
				                    <span class="name">John Smith:</span>
				                    <span class="message">Hey there, I wanted to ask you something...</span>
				                    <span class="time"><i class="fa fa-clock-o"></i> 4:34 PM</span>
			                  	</a>
			                </li>
			                <li class="divider"></li>
			                <li class="message-preview">
			                  	<a href="#">
				                    <span class="avatar"><img src="http://placehold.it/50x50"></span>
				                    <span class="name">John Smith:</span>
				                    <span class="message">Hey there, I wanted to ask you something...</span>
				                    <span class="time"><i class="fa fa-clock-o"></i> 4:34 PM</span>
			                  	</a>
			                </li>
			                <li class="divider"></li>
			                <li><a href="#">View Inbox <span class="badge">7</span></a></li>
		              	</ul>
	            	</li>
		            <li class="dropdown alerts-dropdown">
		              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> Alerts <span class="badge">3</span> <b class="caret"></b></a>
		              <ul class="dropdown-menu">
		                <li><a href="#">Default <span class="label label-default">Default</span></a></li>
		                <li><a href="#">Primary <span class="label label-primary">Primary</span></a></li>
		                <li><a href="#">Success <span class="label label-success">Success</span></a></li>
		                <li><a href="#">Info <span class="label label-info">Info</span></a></li>
		                <li><a href="#">Warning <span class="label label-warning">Warning</span></a></li>
		                <li><a href="#">Danger <span class="label label-danger">Danger</span></a></li>
		                <li class="divider"></li>
		                <li><a href="#">View All</a></li>
		              </ul>
		            </li>
		            <li class="dropdown user-dropdown">
		              	<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> John Smith <b class="caret"></b></a>
		              	<ul class="dropdown-menu">
			            	<li><a href="#"><i class="fa fa-user"></i> Profile</a></li>
			                <li><a href="#"><i class="fa fa-envelope"></i> Inbox <span class="badge">7</span></a></li>
			                <li><a href="#"><i class="fa fa-gear"></i> Settings</a></li>
			                <li class="divider"></li>
			                <li><a href="#"><i class="fa fa-power-off"></i> Log Out</a></li>
		              	</ul>
		            </li>
	          	</ul>
	        </div><!-- /.navbar-collapse -->
		</nav>

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
									<a href="#">
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
				        	$btn_link_add	 = URL::route('student.penalty.create', $student->id);
				        	$btn_disable_add = ($btn_link_add == Request::url()) ? 'disabled' : '' ; 

				        	$btn_link_view	 = URL::route('student.penalty.index', $student->id);
				        	$btn_disable_view = ($btn_link_view == Request::url()) ? 'disabled' : '' ; 
				        ?>
						<a href="{{$btn_link_add}}" class="btn btn-danger {{$btn_disable_add}}" type="button">
			                <i class="fa fa-plus"></i>
						    Add Violation Record
						</a>
						<a href="{{$btn_link_view}}" class="btn btn-default {{$btn_disable_view}}" type="button">
			                <i class="fa fa-list"></i>
						    View Violation List
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
    <script src="{{ asset('js/jquery-1.10.2.js'); }}"></script>
    <script src="{{ asset('js/bootstrap.js'); }}"></script>
	
	@yield('footer')
</footer>
</html>