@extends('layout-quiz')

@section('content')
	<div class="container quiz-form">
		{{ Form::open(array('url' => 'scholarship/quiz/'.$user.'/'.$scholarship_quiz_id.'/submit','role' => 'form')) }}
		<?php 
			$question_count = 0; 
			$subject 		= "";
		?>
		<h1 class="center"><i class="fa fa-bookmark-o fa-green"></i> {{ Str::upper($scholarhip_quizzes->quiz->title) }} <i class="fa fa-bookmark-o fa-green"></i></h1>
		<p><h2>INSTRUCTION:</h2> {{ $scholarhip_quizzes->quiz->instruction }}</p>

		@foreach($scholarhip_quizzes->quiz->quiz_question as $questions)
			<?php 
				$question_count += 1; 
				if($subject != $questions->subject->name) {
					echo "<h2 class='center'><i class='fa fa-book fa-green'></i> ".Str::upper($questions->subject->name)." <i class='fa fa-book fa-green fa-flip-horizontal'></i></h2>";
					$subject = $questions->subject->name;
					$question_count = 1; 
				}
			?>
			<?php //var_dump($questions->question->subject_id); ?>
			<h3 class="question"><i class="fa fa-question fa-green"></i> QUESTION NO {{ $question_count }}</h3>
			<div class="container">
				<p><b>TITLE :</b> {{ $questions->question->title }}</p>
				<p><b>DESCRIPTION :</b> {{ $questions['description'] }}</p>
				<p><b>CONTENT :</b> {{ $questions->question->content }}</p>
				<h3><i class="fa fa-list-ul fa-green"></i> CHOICES</h3>
				<div class="container">
					@if (count($questions->question->question_choice) == 0)
						{{ "THERE IS NO CHOICE GIVEN. IF YOU THINK THIS IS A MISTAKE YOU MAY CONTACT US HERE." }}
					@else
						@foreach($questions->question->question_choice as $choices)				
							<label class="radio">
								<input type='radio' name='{{ $questions["question"]["id"] }}' value='{{ $choices["choice"]["id"] }}'>
								{{ $choices->choice->content }}
							</label>  
						@endforeach
					@endif
				</div>
			</div>
		@endforeach

		<div style="text-align:center; margin:10px 0px;">
			<button id ="submit_button" data-toggle="modal" data-target="#submit" class="btn btn-success" type="button"><i class="fa fa-check"></i> SUBMIT ANSWERS AND PRINT <i class="fa fa-print"></i></button>
			<!-- <a href="{{ URL::to('/'); }}" class="btn btn-warning"><i class="fa fa-times"></i> CANCEL</a> -->
		</div> 
	</div>

	<!--S: CONFIMATION MODAL FOR CONFIRMING QUIZ SUBMISSION-->
	<div class="modal fade" id="submit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button id = "close_submission" type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="check_time()">&times;</button>
					<h2 class="modal-title" id="myModalLabel"><i class="fa fa-check"></i> SUBMIT ANSWER</h3>
				</div>
				<div class="modal-body">
					<td>ARE YOU SURE YOU WANT TO SUBMIT YOUR ANSWER?</td>
				</div>
				<div class="modal-footer">
					<button class="btn btn-success" type="submit">CONTINUE TO SUBMISSION</button>
					<button id = "cancel_submission" class="btn btn-small" data-dismiss="modal" aria-hidden="true" onclick="check_time()">CANCEL</button>
				</div>
			</div>
		</div>
	</div>
	<!--E: CONFIMATION MODAL FOR CONFIRMING QUIZ SUBMISSION -->

	{{ Form::close() }}

    <!--S: TIMER -->
    @if($time_limit != 0)
      <script>
      	var date_started 	= {{ $date_started }};
        var time_remaining  = date_started - {{ (time() - $time_limit * 60) }};
        var counter         = setInterval(timer, 1000);
        var ms_remaining; 

        function timer() {
          var hours;
          var minutes;
          var seconds;

          //S: CHECK IF ALREADY TIME
          if (time_remaining <= 0) {
            clearInterval(counter);
            $("#submit_button").click();
            $("#cancel_submission").remove();
            $("#close_submission").remove();
            return;
          }
          //E: CHECK IF ALREADY TIME

          time_remaining = time_remaining - 1;

          //S: CONVERT SECONDS TO TIME FRIENDLY FORMAT
          hours         = Math.floor(time_remaining / 3600);
          ms_remaining  = time_remaining - hours * 3600;
          minutes       = ("0" + Math.floor(ms_remaining / 60)).slice(-2);
          seconds       = ("0" + (ms_remaining - minutes * 60)).slice(-2);

          hours = ("0" + hours).slice(-2);
          //E: CONVERT SECONDS TO TIME FRIENDLY FORMAT

        //alert(hours + ":" + minutes + ":" + seconds);
          
          $("#timer").html("<h3><i class='fa fa-clock-o'></i> TIME LEFT : " + hours + "<span class='seperator'>HOUR </span> " + minutes + "<span class='seperator'>MIN </span> " + seconds + "<span class='seperator'>SEC</span></h3>");
        }
      </script>
	@endif
@stop