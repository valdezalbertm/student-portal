<?php

class UserQuizController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($user, $scholarship_quiz_id)
	{
		$user_result_model = ($user == 'student' ? 
						'StudentScholarshipQuizResult' : 
						'ApplicantScholarshipQuizResult'
					 );

		$validator = $user_result_model::find($scholarship_quiz_id);

		if (!isset($validator)) {
	        Session::flash('message', 'Please follow the proper procedure of entering on quiz.');
	        Session::flash('class', 'alert-danger');

	        return Redirect::to('scholarship');
		}
		
		$scholarhip_quizzes = $user_result_model::where('id', '=', $scholarship_quiz_id)
										->with(array($user, 
													 'scholarship', 
													 'quiz',
													 'quiz.quiz_question' => function($query) { 
														 $query->orderBy('subject_id', 'ASC')
														  	   ->orderBy(DB::raw('RAND()'));
													 }, 
													 'quiz.quiz_question.question',
													 'quiz.quiz_question.question.question_choice'=> function($query) { 
														 $query->orderBy(DB::raw('RAND()'));
													 },
													 'quiz.quiz_question.question.question_choice.choice',
													 'quiz.quiz_question.subject'
													 )
											  ) 
										 ->first();
		//return $scholarhip_quizzes;
		$time_limit 	= $scholarhip_quizzes->quiz->time_limit;
		$date_started	= strtotime($scholarhip_quizzes->date_started);
						
		$time_remaining = $date_started - (time() - $time_limit * 60);

		//S DISPLAY BASED ON TIME STATUS
		if ($time_remaining <= 0) {
			$timer['hours'] = "00";
			$timer['minutes'] = "00";
			$timer['seconds'] = "00";
		} else {
			$timer['hours'] = intval($time_remaining / 3600);
			$time_remaining = $time_remaining - $timer['hours'] * 3600;
			$timer['minutes'] = intval($time_remaining / 60);
			$timer['seconds'] = $time_remaining - $timer['minutes'] * 60;
		}
		//E DISPLAY BASED ON TIME STATUS
	 
		return View::make('user.quiz.index')
				   ->with('user', $user)
				   ->with('scholarship_quiz_id', $scholarship_quiz_id)
				   ->with('scholarhip_quizzes', $scholarhip_quizzes)
				   ->with('time_limit', $time_limit)
				   ->with('date_started', $date_started)
				   ->with('timer', $timer);
	}

	public function submit($user, $scholarship_quiz_id)
	{
		if($user == 'student') {
			$user_result_model 	= 'StudentScholarshipQuizResult';
			$user_answer_model	= 'StudentScholarshipQuizAnswer';
			$user_answer_column	= 'student_scholarship_quiz_result_id';
		} else {
			$user_result_model 	= 'ApplicantScholarshipQuizResult';
			$user_answer_model	= 'ApplicantScholarshipQuizAnswer';
			$user_answer_column	= 'applicant_scholarship_quiz_result_id';
		}

		// S: CHECK IF STUDENT ALREADY HAVE A RESULT
		$scholarship_quiz = $user_result_model::find($scholarship_quiz_id);

		if ($scholarship_quiz->procedure == 'pass') {
	        // Session::flash('message', 'Student already submit the exam.');
	        // Session::flash('class', 'alert-danger');

	        // return Redirect::to('scholarship');			

			return Redirect::to('user/scholarship/quiz/'.$user.'/'.$scholarship_quiz_id.'/result');				  		   
		} 						  
		// E: CHECK IF STUDENT ALREADY HAVE A RESULT



		$score 			= 0;
		$overall 		= 0;
		$answer 		= array();
		// $validation_key = rand(10000, 99999);
		
		$scholarship_quiz = $user_result_model::where('id', '=', $scholarship_quiz_id)
											 ->with($user, 
													'scholarship', 
													'quiz.quiz_question.question.question_choice.choice')
										  	 ->first();
	
		// S: COUNT NUMBER OF CORRECT ANSWER
		foreach ($scholarship_quiz->quiz->quiz_question as $questions) {
			$overall += 1;
			$correct = false; 
			foreach ($questions->question->question_choice as $question) {
				if ($question->answer == 1) {
					if ($question->choice_id == Input::get($question->question_id)) {
						$score += 1;
						$correct = true; 
						// S: PREPARE QUERY FOR MULTIPLE INSERT FOR CORRECT ANSWER
						array_push($answer, array($user_answer_column => $scholarship_quiz_id,
												  'question_id' => $question->question_id, 
												  'choice_id' => $question->choice_id, 
												  'correct' => 1));
						// E: PREPARE QUERY FOR MULTIPLE INSERT FOR CORRECT ANSWER
					}
				}
			}
			if($correct == false) {
				// S: PREPARE QUERY FOR MULTIPLE INSERT FOR WRONG ANSWER
				array_push($answer, array($user_answer_column => $scholarship_quiz_id,
										  'question_id' => $question->question_id, 
										  'choice_id' => $question->choice_id, 
										  'correct' => 0));
				// E: PREPARE QUERY FOR MULTIPLE INSERT FOR WORNG ANSWER
			}
		}
		// E: COUNT NUMBER OF CORRECT ANSWER

		// S: UPDATE TABLE FOR THE RESULT
		$percentage = round(($score / $overall) * 100, 2);

        $result           			= $user_result_model::find($scholarship_quiz_id);
        $result->score     			= $score;
        $result->overall 			= $overall;
        // $result->validation_key 	= $validation_key;
        $result->procedure 			= 'pass';
        $result->is_pass 			= $percentage > 74 ? 1 : 0;
        $result->save();
        // E: UPDATE TABLE FOR THE RESULT

        // S: PERFORM MULTIPLE INSERT
		$user_answer_model::insert($answer);
		// E: PERFORM MULTIPLE INSERT

		return Redirect::to('user/scholarship/quiz/'.$user.'/'.$scholarship_quiz_id.'/result');
	}

	public function result($user_type = null, $user, $scholarship_quiz_id)
	{
		if($user == 'student') {
			$user_result_model 	= 'StudentScholarshipQuizResult';
			$user_answer_model	= 'StudentScholarshipQuizAnswer';
			$user_answer_table	= 'student_scholarship_quiz_answer';
			$user_answer_column	= 'student_scholarship_quiz_result_id';
		} else {
			$user_result_model 	= 'ApplicantScholarshipQuizResult';
			$user_answer_model	= 'ApplicantScholarshipQuizAnswer';
			$user_answer_table	= 'applicant_scholarship_quiz_answer';
			$user_answer_column	= 'applicant_scholarship_quiz_result_id';
		}

		$scholarship_quiz = $user_result_model::where('id', '=', $scholarship_quiz_id)
											 ->with(array($user, 
														  'scholarship', 
														  'quiz',
														  'quiz.quiz_question' => function($query) { 
														  	  $query->orderBy('subject_id', 'ASC');
														  }, 

														  'quiz.quiz_question.question.question_choice' => function($query) { 
														  	  $query->where('answer', '=', '1');
														  }, 
														  'quiz.quiz_question.question.question_choice.choice',
														  'quiz.quiz_question.question.'.$user_answer_table => function($query) use($scholarship_quiz_id, $user_answer_column) { 
														  	  $query->where($user_answer_column, '=', $scholarship_quiz_id);
														  }, 
														  'quiz.quiz_question.question.'.$user_answer_table.'.choice'))
										  	 ->first();

		return View::make('user.quiz.result')
				   ->with('user', $user)
				   ->with('user_type', $user_type)
				   ->with('scholarship_quiz', $scholarship_quiz);
	}

	public function updateScholarshipStatus()
	{
		if (!Account::check_admin_session()) {
			return View::make('admin.login');
		} 
		
 		if (Request::ajax()) {
			if($_POST['user'] == 'student') {
				$user_result_model 	= 'StudentScholarshipQuizResult';
				$result_id 			= $_POST['result_id'];
			} else {
				$user_result_model 	= 'ApplicantScholarshipQuizResult';
				$result_id 			= $_POST['result_id'];
			}

            $user_scholarship_quiz_result		   = $user_result_model::find($result_id);
            $user_scholarship_quiz_result->is_pass = ($_POST['is_pass'] == 1) ? 0 : 1;
            $user_scholarship_quiz_result->save();

	        $response[0] = ($_POST['is_pass'] == 1) ? 'correct' : 'wrong';
	        $response[1] = ($_POST['is_pass'] == 1) ? 'wrong' : 'correct';
	        $response[2] = ($_POST['is_pass'] == 1) ? 'fa fa-times' : 'fa fa-check';
	        $response[3] = ($_POST['is_pass'] == 1) ? 'fa fa-check' : 'fa fa-times';
	        $response[4] = ($_POST['is_pass'] == 1) ? 0 : 1;

 			return $response;
    	}
    	
    	return "INVALID REQUEST";
	}
}