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
	        		@if(Session::get('exam_station_mode') == null)
		        		<h2><i class="fa fa-certificate"></i> REGISTER FOR SCHOLARSHIP GRANT</h2>
		        		<center>
		        			<a href="#student" onclick="closeAlert()"><i class="fa fa-user"></i> STUDENT</a> 
		        			&#8226;	
		        			<a href="#applicant" onclick="closeAlert()"><i class="fa fa-users"></i> APPLICANT</a>
		        		</center>
		        		<div class="applicant-wrapper">
			        		<div id="student" class="student">
			                   <!-- S: SHOW FORM VALIDATION ERRORS -->
			                    @if($errors->has() or Session::has('message'))
			                        <div class="alert alert-danger alert-dismissable fade in">
			                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			                            {{ HTML::ul($errors->all()) }}
			                            {{ Session::get('message') }}
			                        </div>
			                    @endif
			                    <!-- E: SHOW FORM VALIDATION ERRORS -->

			                    {{ Form::open(array('url' => 'scholarship/student','role' => 'form')) }}
			                    	<!-- S: HIDDEN FIELDS -->
			                    	{{ Form::hidden('student_id', null) }}
			                    	{{ Form::hidden('school_year', null) }}
			                    	<!-- E: HIDDEN FIELDS -->
			                        <div class="form-group">
			                            {{ Form::label('title', 'STUDENT NUMBER', array('class' => 'label-md')) }}
			                            {{ Form::text('student_number', Input::old('student_number'), array('class' => 'form-control', 'placeholder' => 'STUDENT NUMBER', 'required')) }}
			                        </div>

			                        <div class="form-group">
			                            {{ Form::label('title', 'PASSWORD', array('class' => 'label-md')) }}
			                            {{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'PASSWORD', 'required')) }}
			                        </div>

			                        <div class="form-group">
			                            {{ Form::label('scholarship_info', 'SELECT SCHEDULE', array('class' => 'label-md')) }}
			                            {{ Form::select('scholarship_info', $scholarship_name, null, array('class' => 'form-control')) }}
			                        </div>

			                        <div class="pull-right">
			                            {{ HTML::decode(Form::button('REGISTER SCHOLARSHIP GRANT EXAMINATION <i class="fa fa-angle-double-right"></i>', array('type' => 'submit','class'=>'btn btn-success'))) }}
			                        </div>
			                    {{ Form::close() }}
			            	</div>
			        		<div id="applicant" class="applicant">
			                   <!-- S: SHOW FORM VALIDATION ERRORS -->
			                    @if($errors->has() or Session::has('message'))
			                        <div class="alert alert-danger alert-dismissable fade in">
			                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			                            {{ HTML::ul($errors->all()) }}
			                            {{ Session::get('message') }}
			                        </div>
			                    @endif
			                    <!-- E: SHOW FORM VALIDATION ERRORS -->

			                    {{ Form::open(array('url' => 'scholarship/applicant','role' => 'form')) }}
			                        <div class="form-group">
			                            {{ Form::label('title', 'FIRST NAME', array('class' => 'label-md')) }}
			                            {{ Form::text('first_name', Input::old('first_name'), array('class' => 'form-control', 'placeholder' => 'FIRST NAME', 'required')) }}
			                        </div>

			                        <div class="form-group">
			                            {{ Form::label('title', 'LAST NAME', array('class' => 'label-md')) }}
			                            {{ Form::text('last_name', Input::old('last_name'), array('class' => 'form-control', 'placeholder' => 'LAST NAME', 'required')) }}
			                        </div>

			                        <div class="form-group">
			                            {{ Form::label('title', 'MIDDLE NAME', array('class' => 'label-md')) }}
			                            {{ Form::text('middle_name', Input::old('middle_name'), array('class' => 'form-control', 'placeholder' => 'MIDDLE NAME', 'required')) }}
			                        </div>

			                        <div class="form-group">
			                            {{ Form::label('title', 'CONTACT', array('class' => 'label-md')) }}
			                            {{ Form::text('contact', Input::old('contact'), array('class' => 'form-control', 'placeholder' => 'CONTACT', 'required')) }}
			                        </div>

			                        <div class="form-group">
			                            {{ Form::label('title', 'EMAIL', array('class' => 'label-md')) }}
			                            {{ Form::email('email', Input::old('email'), array('class' => 'form-control', 'placeholder' => 'EMAIL', 'required')) }}
			                        </div>

			                        <div class="form-group">
			                            {{ Form::label('scholarship_info', 'SELECT SCHEDULE', array('class' => 'label-md')) }}
			                            {{ Form::select('scholarship_info', $scholarship_name, null, array('class' => 'form-control')) }}
			                        </div>

			                        <div class="pull-right">
			                            {{ HTML::decode(Form::button('REGISTER SCHOLARSHIP GRANT EXAMINATION <i class="fa fa-angle-double-right"></i>', array('type' => 'submit','class'=>'btn btn-success'))) }}
			                        </div>
			                    {{ Form::close() }}
			            	</div>
			            </div>
						<center>
							YOU MAY WANT TO KNOW THE 
		        			<a href="#" data-toggle="modal" data-target="#examination-details">EXAMINATION DETAILS</a>
		        			&#8226;	
		        			<a href="#" data-toggle="modal" data-target="#requirement-list">LIST OF REQUIREMENTS</a>
		        		</center>
					@else
						<h2><i class="fa fa-lock"></i> ENTER VALIDATION TO TAKE EXAMINATION</h2>
		        		<div class="validation-wrapper">
		                   <!-- S: SHOW FORM VALIDATION ERRORS -->
		                    @if($errors->has() or Session::has('message'))
		                        <div class="alert alert-danger alert-dismissable fade in">
		                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                            {{ HTML::ul($errors->all()) }}
		                            {{ Session::get('message') }}
		                        </div>
		                    @endif
		                    <!-- E: SHOW FORM VALIDATION ERRORS -->

		                    {{ Form::open(array('url' => 'scholarship/validation','role' => 'form')) }}
		                        <div class="form-group">
		                            {{ Form::text('validation_key', Input::old('validation_key'), array('class' => 'form-control center', 'placeholder' => 'ENTER VALIDATION KEY', 'required')) }}
		                        </div>

		                        <div class="pull-right">
		                            {{ HTML::decode(Form::button('TAKE SCHOLARSHIP GRANT EXAMINATION <i class="fa fa-angle-double-right"></i>', array('type' => 'submit','class'=>'btn btn-success'))) }}
		                        </div>
		                    {{ Form::close() }}
			            </div>
					@endif
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
	<div class="modal fade" id="examination-details" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h2 class="modal-title" id="myModalLabel"><i class="fa fa-pencil"></i> EXAMINATION DETAILS</h3>
				</div>
				<div class="modal-body">
					<div style="text-align:justify;">
						<h3>INSTRUCTION</h3>
						<p>Our examinations are presented locally by the supervision of the system administrator. This has the advantage of enabling the Academy to closely monitor your progress and answers. It also provides a result immediately -- on completion of the exam.</p>
	
						<h3>EXAM TIME</h3>
						<p>The exam time for each course is stated in your course completion instruction window for each course. It ranges from 30 minutess to 4 hours. You will be graded either when you click the “SUBMIT EXAMINATION” button or the time is reached.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- E: ABOUT THIS PORTAL MODAL -->

	<!-- S: REQUIREMENTS MODAL -->
	<div class="modal fade" id="requirement-list" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h2 class="modal-title" id="myModalLabel"><i class="fa fa-list"></i> LIST OF REQUIREMENTS</h3>
				</div>
				<div class="modal-body">
					<div style="text-align:justify;">
						<ul>
							<li>BIRTH CERTIFICATE</li>
							<li>2X2 PICTURE</li>
							<li>REPORT CARD OF PREVIOUS SCHOOL</li>
							<li>CERTIFICATE OF GOOD MORAL CHARACTER</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- E: REQUIREMENTS MODAL -->

    <script>
        function closeAlert() {
            $("button.close").trigger("click"); 
        }
    </script>
@stop