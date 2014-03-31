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
	        	<div class="container scholarhip-form">
					<h2><i class="fa fa-trophy"></i> SCHOLARSHIP PASSERS</h2>
	        		<div class="passers-wrapper">
	        			<p>Congratulations to the following for successfully passing the St. Jude Academy of Dasmarinas scholarship.</p>
	        			@if(count($passers) == 0)
	                        <div class="alert alert-warning center">
	                            THERE ARE NO PASSERS YET. IF YOU THINK THIS IS A MISTAKE, KINDLY SEND US A FEEDBACK. 
	                        </div>
	        			@else
		        			<ul>
							@foreach ($passers as $passer)
								<li>{{ $passer }}</li>
							@endforeach
							</ul>
						@endif
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
    <script>
        function closeAlert() {
            $("button.close").trigger("click"); 
        }
    </script>
@stop