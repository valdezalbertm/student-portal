@extends('layout2')

@section('content')

	<!-- THIS IS A TYPICAL TWITTER BOOTSTRAP CAROUSEL -->
	<!-- CAROUSEL -->
	<div id="carousel-facilities" class="carousel slide" data-ride="carousel">
		<!-- INDICATORS -->
		<ol class="carousel-indicators">
			<li data-target="#carousel-facilities" data-slide-to="0" class="active"></li>
			<li data-target="#carousel-facilities" data-slide-to="1"></li>
			<li data-target="#carousel-facilities" data-slide-to="2"></li>
			<li data-target="#carousel-facilities" data-slide-to="3"></li>
			<li data-target="#carousel-facilities" data-slide-to="4"></li>
			<li data-target="#carousel-facilities" data-slide-to="5"></li>
		</ol>

		<!-- WRAPPER FOR SLIDES -->
		<div class="carousel-inner">
			<div class="item active">
				<img src="{{ URL::asset('assets/img/facilities-1.jpg') }}" alt="" />
				<div class="container">
					<div class="carousel-caption">
						<h1>NEW BUILDING</h1>
						<p class="lead">THE 4-STOREY BUILDING OF ST. JUDE OF DASMARIÑAS ALSO KNOWN AS THE NEW BUILDING. IT HAS 12 ROOMS, OF WHICH ARE USED AS CLASSROOMS <br> FOR THE ELEMENTARY PUPILS AND HIGH SCHOOL STUDENTS.
						</p>
						<div class="btn-group">
							<a href="http://sjaod.tripod.com/bldgandfaci.htm#NewBLDG" target="_blank" type="button" class="btn btn-success transparent-inverse">
								<i class="fa fa-info"></i>
								<!-- <i class="fa fa-info"></i> -->
								MORE INFO
							</a>
							<a id="links" href="{{ URL::asset('assets/img/facilities-1-clear.jpg') }}" type="button" class="btn btn-success transparent-inverse" title="NEW BUILDING" data-gallery="facilities">
								<i class="fa fa-picture-o"></i>
								CLEAR PHOTO
							</a>
						</div>
					</div>
				</div>
			</div>

			<div class="item">
				<img src="{{ URL::asset('assets/img/facilities-2.jpg') }}" alt="" />
					<div class="carousel-caption">
						<h1>2 STOREY BUILDING</h1>
						<p class="lead">THIS BUILDING HAS 12 ROOMS, OF WHICH ARE USED AS CLASSROOMS FOR THE PRE-SCHOOL, ELEMENTARY PUPILS.</p>
						<div class="btn-group">
							<a  href="http://sjaod.tripod.com/bldgandfaci.htm#OldBLDG" target="_blank" type="button" class="btn btn-success transparent-inverse">
								<i class="fa fa-info"></i>
								MORE INFO
							</a>
							<a id="links" href="{{ URL::asset('assets/img/facilities-2-clear.jpg') }}" type="button" class="btn btn-success transparent-inverse" title="2 STOREY BUILDING" data-gallery="facilities">
								<i class="fa fa-picture-o"></i>
								CLEAR PHOTO
							</a>
						</div>
					</div>
			</div>

			<div class="item">
				<img src="{{ URL::asset('assets/img/facilities-3.jpg') }}" alt="" />
				<div class="container">
					<div class="carousel-caption">
						<h1>LABORATORY BUILDING</h1>
						<p class="lead">THIS BUILDING IS WHERE SCIENCE, EPP, TLE LABORATORY ARE PERFORM.</p>
						<div class="btn-group">
							<a  href="http://sjaod.tripod.com/bldgandfaci.htm#Sciencelab" target="_blank" type="button" class="btn btn-success transparent-inverse">
								<i class="fa fa-info"></i>
								MORE INFO
							</a>
							<a id="links" href="{{ URL::asset('assets/img/facilities-3-clear.jpg') }}" type="button" class="btn btn-success transparent-inverse" title="LABORATORY BUILDING" data-gallery="facilities">
								<i class="fa fa-picture-o"></i>
								CLEAR PHOTO
							</a>
						</div>
					</div>
				</div>
			</div>

			<div class="item">
				<img src="{{ URL::asset('assets/img/facilities-4.jpg') }}" alt="" />
				<div class="container">
					<div class="carousel-caption">
						<h1>GYMNASIUM</h1>
						<p class="lead">THE GYMNASIUM IS EQUIPPED WITH MODERN FACILITIES AND THE MATERIALS USED FOR CONSTRUCTION ARE OF TOP QUALITY.</p>
						<div class="btn-group">
							<a href="http://sjaod.tripod.com/bldgandfaci.htm#Gym" target="_blank" type="button" class="btn btn-success transparent-inverse">
								<i class="fa fa-info"></i>
								MORE INFO
							</a>
							<a id="links" href="{{ URL::asset('assets/img/facilities-4-clear.jpg') }}" type="button" class="btn btn-success transparent-inverse" title="GYMNASIUM" data-gallery="facilities">
								<i class="fa fa-picture-o"></i>
								CLEAR PHOTO
							</a>
						</div>
					</div>
				</div>
			</div>

			<div class="item">
				<img src="{{ URL::asset('assets/img/facilities-5.jpg') }}" alt="" />
				<div class="container">
					<div class="carousel-caption">
						<h1>PLAYGROUND</h1>
						<p class="lead">A SIMPLE BUT ENJOYABLE PLAYGOUND IS PROVIDED FOR THE PRE-SCHOOLERS TO HAVE FUN AND HELP THE CHILDRENS <br> ENJOY SCHOOL WHILE LEARNING.</p>
						<div class="btn-group">
							<a href="http://sjaod.tripod.com/bldgandfaci.htm#Playground" target="_blank" type="button" class="btn btn-success transparent-inverse">
								<i class="fa fa-info"></i>
								MORE INFO
							</a>
							<a id="links" href="{{ URL::asset('assets/img/facilities-5-clear.jpg') }}" type="button" class="btn btn-success transparent-inverse" title="PLAYGROUND" data-gallery="facilities">
								<i class="fa fa-picture-o"></i>
								CLEAR PHOTO
							</a>
						</div>
					</div>
				</div>
			</div>

			<div class="item">
				<img src="{{ URL::asset('assets/img/facilities-6.jpg') }}" alt="" />
				<div class="container">
					<div class="carousel-caption">
						<h1>SCHOOL CANTEEN</h1>
						<p class="lead">THE CANTEEN IS HOUSED IN A SEPARATE BUILDING AT THE EDGE OF THE QUADRANGLE.</p>
						<div class="btn-group">
							<a href="http://sjaod.tripod.com/bldgandfaci.htm#Canteen" target="_blank" type="button" class="btn btn-success transparent-inverse">
								<i class="fa fa-info"></i>
								MORE INFO
							</a>
							<a id="links" href="{{ URL::asset('assets/img/facilities-6-clear.jpg') }}" type="button" class="btn btn-success transparent-inverse" title="SCHOOL CANTEEN" data-gallery="facilities">
								<i class="fa fa-picture-o"></i>
								CLEAR PHOTO
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div id="wrap">
	        <div class="container">
	        	<div class="container pull-right navigation">
		        	<div class="btn-group-vertical pull-right" style="min-width: 335px;">
						<a href="scholarship/passers" type="button " class="btn btn-success transparent-btn-success">
							<i class="fa fa-trophy"></i>
							SCHOLARSHIP PASSERS
						</a>
						<a href="scholarship" type="button" class="btn btn-default transparent-btn-default">
							@if(Session::get('exam_station_mode') == null)
								<i class="fa fa-certificate"></i> REGISTER FOR SCHOLARHIP GRANT
							@else 
								<i class="fa fa-pencil"></i> TAKE EXAMINATION
							@endif
						</a>
						<a type="button" class="btn btn-default transparent-btn-default" data-toggle="modal" data-target="#about-this-portal">
							<i class="fa fa-users"></i> 
							ABOUT STUDENT PORTAL
						</a>
						<a href="http://sjaod.tripod.com/" type="button" class="btn btn-success transparent-btn-success">
							<i class="fa fa-globe"></i> 
							OFFICIAL WEBSITE
						</a>
					</div> 
				</div>

	        	<div class="container pull-left navigation">
		        	<div class="btn-group-vertical pull-left" style="min-width: 335px;">
						<a  type="button " class="btn btn-success transparent-btn-success">
							<i class="fa fa-list"></i>
							ANNOUNCEMENT
						</a>
						<a type="button" class="btn btn-default transparent-btn-default">
							{{ $ann[0]->subject }} : {{ $ann[0]->description }}
						</a>
					</div> 
				</div>
	        </div>
		</div>


		<div id="footer">
			<div class="container"> 
				<div class="col-md-4"> 
					FOLLOW US ON 
					<ul class="social-nav">
			          <li id="facebook" class="facebook" data-toggle="tooltip" title="LIKE US ON FACEBOOK"><a href="https://www.facebook.com/SJAoD" target="_blank"></a></li>
			          <li id="twitter" class="twitter" data-toggle="tooltip" title="FOLLOW US ON TWITTER"><a href="#" target="_blank"></a></li>
			        </ul>
				</div>
				<div class="col-md-4 text-center">
					ST JUDE ACADEMY &copy; 2013
				</div>
				<div class="col-md-4 text-right">
					<i class="fa fa-envelope-o"></i> <a href="mailto:feedback.sja@gmail.com"><span>SEND FEEDBACK</span></a>
					<!-- 
					&#8226; 
					<i class="fa fa-question"></i> <a href="{{ URL::to('faqs'); }}"><span>FAQS</span></a>
					&#8226; 
					<i class="fa fa-code"></i> <a href="{{ URL::to('developers'); }}"><span>DEVELOPERS</span></a> -->
				</div>
			</div>
		</div>

		<!-- CONTROLS -->
		<a class="left carousel-control" href="#carousel-facilities" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left"></span>
		</a>
		<a class="right carousel-control" href="#carousel-facilities" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right"></span>
		</a>
	</div>

	<!-- THE GALLERY AS LIGHTBOX DIALOG, SHOULD BE A CHILD ELEMENT OF THE DOCUMENT BODY -->
	<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls">
	    <div class="slides"></div>
	    <h3 class="title"></h3>
	    <a class="prev">‹</a>
	    <a class="next">›</a>
	    <a class="close">×</a>
	    <a class="play-pause"></a>
	    <ol class="indicator"></ol>
	</div>

	<!-- S: ABOUT THIS PORTAL MODAL -->
	<div class="modal fade" id="about-this-portal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h2 class="modal-title" id="myModalLabel"><i class="fa fa-users"></i> ABOUT STUDENT PORTAL</h3>
				</div>
				<div class="modal-body">
					<div style="text-align:center;">
						<img src="{{ URL::asset('assets/img/sjaod-logo.png') }}" style="width:150px;"/>
						<h3>ST JUDE ACADEMY STUDENT PORTAL</h3>
						<p>CURRENT VERSION 1.0</p>
					</div>
					<div style="text-align:center;">
						<h3>DEVELOPER</h3>
						<p>SLASH I.T. UP!<br><a href="{{ URL::to('developers'); }}">MORE DETAILS ON DEVELOPER</a></p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- E: ABOUT THIS PORTAL MODAL -->
@stop