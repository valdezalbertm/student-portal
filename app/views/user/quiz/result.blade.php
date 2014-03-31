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

		<style type="text/css">
			@media print {
				body * {
					visibility: hidden;
				}
				#section-to-print, #section-to-print * {
					visibility: visible;
				}
				#section-to-print {
					position: absolute;
					left: 0;
					top: 0;
				}
			}
		</style>

		<title>Examination Result - St. Jude Academy Student Portal</title>
	</head>
    <body>
		<div class="container result-form">
			<div class="result-nav">
				@if($user_type == 'user')
					<h2 class="pull-left"><a href="{{ URL::to('/') }}"><i class="fa fa-home"></i> HOME</a></h2>
				@endif

				<h2 class="pull-right"><a href="#" onclick="print_page()"><i class="fa fa-print"></i> PRINT RESULT</a></h2>
			</div>

			<div class="alert alert-info">
				@if(Session::get('account_type') == 'Administrator' and $user_type == 'administrator')
					<p><i class="fa fa-warning"></i> NOTE: YOU ARE VIEWING AS AN ADMINISTRATOR. SCORE AND CORRECTION ARE VISIBLE WHEN VIEWING USING THIS ACCOUNT.</p>
					<p> PLEASE PRINT THE <b>SCHOLARSHIP EXAMINATION RESULT SUMMARY</b> AND PASS IT TO THE GUIDANCE OFFICE FOR THE RESULTS AND FOR MORE INFORMATION</p>
				@else
					<i class="fa fa-warning"></i> NOTE: PLEASE PRINT THE <b>SCHOLARSHIP EXAMINATION RESULT SUMMARY</b> AND PASS IT TO THE GUIDANCE OFFICE FOR THE RESULTS AND FOR MORE INFORMATION
				@endif
			</div>

			<div id="section-to-print">
				<!-- <h2>SCHOLARSHIP EXAMINATION RESULT SUMMARY</h2> -->
				<p><i class='fa fa-user'></i> <b>STUDENT NAME:</b> {{ $scholarship_quiz->$user->last_name.', '.$scholarship_quiz->$user->first_name.' '.$scholarship_quiz->$user->middle_name.'.' }}</p>
				<p><i class='fa fa-certificate'></i> <b>SCHOLARSHIP NAME:</b> {{ $scholarship_quiz->scholarship->name }}</p>
				<p><i class='fa fa-calendar'></i> <b>SY APPLIED:</b> {{ $scholarship_quiz->school_year }}</p>
				<p><i class='fa fa-lock'></i> <b>VALIDATION KEY:</b> {{ $scholarship_quiz->validation_key }}</p>
				<p><i class='fa fa-calendar'></i> <b>DATE TAKEN:</b> {{ date('F d, Y', strtotime($scholarship_quiz->date_started)) }}</p>
				@if(Session::get('account_type') == 'Administrator' and $user_type == 'administrator')
				<p><i class='fa fa-check'></i> <b>CORRECT ANSWER:</b> {{ $scholarship_quiz->score.'/'.$scholarship_quiz->overall }}</p>
				<p><i class="icon-percent"></i> <b>PERCENT:</b> {{ ($scholarship_quiz->score / $scholarship_quiz->overall) * 100 }} {{ ($scholarship_quiz->is_pass == 1) ? ' (PASSED)' : ' (FAILED)' }}</p>
					<h2>ANSWER KEY</h2>
					<?php 
						$subject = ""; 
						$user_result_model = ($user == 'student' ? 
								'student_scholarship_quiz_answer' : 
								'applicant_scholarship_quiz_answer'
							 );
					?>
					<h1 class="center"><i class="fa fa-bookmark-o fa-green"></i> {{ Str::upper($scholarship_quiz->quiz->title) }} <i class="fa fa-bookmark-o fa-green"></i></h1>
					<p><h2>INSTRUCTION:</h2> {{ $scholarship_quiz->quiz->instruction }}</p>
					@foreach($scholarship_quiz->quiz->quiz_question as $questions)
						@if($questions->question->$user_result_model != null)
							@if($subject != $questions->subject->name)
								{{ "<h2 class='center'><i class='fa fa-book fa-green'></i> ".Str::upper($questions->subject->name)." <i class='fa fa-book fa-green fa-flip-horizontal'></i></h2>" }}
								<?php 
									$subject = $questions->subject->name;
									$question_count = 0; 
								?>
							@endif
						<?php $question_count += 1; ?>
						<h3 class="question">QUESTION NO {{ $question_count }}</h3>
						<div class="container">
							<p><b>CONTENT :</b> {{ $questions->question->content }}</p>
							<h3>CORRECT ANSWER</h3>
							<div class="container">
								@foreach($questions->question->question_choice as $choices)				
									<ul>
										<li>{{ $choices->choice->content }}</li>
									</ul>
								@endforeach
							</div>
							<h3>YOUR ANSWER {{ $questions->question->$user_result_model->correct == 1 ?' <i class="fa fa-check fa-green">' : '<i class="fa fa-times fa-red">' }} </i></h3>
							{{ $questions->question->$user_result_model->choice->content }}

						</div>
						@endif
					@endforeach
				@endif
			</div>

			@if(Session::get('account_type') == 'Administrator' and $user_type == 'administrator')
				<div class="result-nav">
					<h2 class="pull-right"><a href="#" onclick="print_page()"><i class="fa fa-print"></i> PRINT RESULT</a></h2>
				</div>			
			@endif

		</div>
	    <script>
	      function print_page() {
	        window.print();
	      }
	    </script>
    </body>
</html>