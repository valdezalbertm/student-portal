<?php

class UserScholarshipController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		// return Session::all();
		$scholarships = ScholarshipQuiz::with(array('quiz.quiz_schedule' => function($query) {
													 $query->where('to', '>', date('Y-m-d H:i:00'));
													},
													'scholarship.scholarship_discount'))
								 	   ->get();
					 
		$scholarship_name = [];

		foreach ($scholarships as $scholarship) {
			// foreach ($scholarship->scholarship->scholarship_discount as $discount) {
			// 	if ($scholarship->school_year == $discount->school_year) {
			// 		$value = ($scholarship->type == 'fix') ? 'P'.$scholarship->value : $scholarship->value.'%';
			// 		// foreach ($scholarship->quiz->quiz_schedule as $schedule) {
			// 		$scholarship_name[$scholarship->id] = Str::upper($scholarship->scholarship->name." SCHOLARSHIP FOR ".
			// 														 "SCHOOL YEAR ".$scholarship->school_year);
			// 		// }
			// 	}
			// }
			foreach ($scholarship->quiz->quiz_schedule as $schedule) {
				$value 	= ($scholarship->type == 'fix') ? 'P'.$scholarship->value : $scholarship->value.'%';
				$title 	= Str::upper($scholarship->scholarship->name." SCHOLARSHIP FOR SCHOOL YEAR ".$scholarship->school_year);
				$start 	= date('m/d/Y g:i A', strtotime($schedule->from));
				$end 	= date('m/d/Y g:i A', strtotime($schedule->to));
				// $scholarship_name[$scholarship->id] = Str::upper($scholarship->scholarship->name." SCHOLARSHIP FOR ".
				// 												 "SCHOOL YEAR ".$scholarship->school_year);
				//date('Y-m-d H:i:s', strtotime(Input::get('from')));
				$scholarship_name[$title][$scholarship->id.'<=S=I=U=>'.$schedule->id] = "START: ".$start." END: ".$end." SLOTS: ".($schedule->slots - $schedule->registered);
				
			}
		}

		// return $scholarship_name;
		return View::make('user.scholarship.index')
				   ->with('scholarship_name', $scholarship_name);
	}

	/*/
	/*	DISPLAY LIST OF SCHOLARSHIP PASSERS.
	/*/
	public function passers()
	{
		$student_scholarship_quiz_passers = StudentScholarshipQuizResult::where('is_pass', '=', 1)
									  ->with(array('student', 
									 			   'scholarship'))
					    			  ->get();

		$applicant_scholarship_quiz_passers = ApplicantScholarshipQuizResult::where('is_pass', '=', 1)
									  ->with(array('applicant', 
									 			   'scholarship'))
					    			  ->get();

		$passers = [];
		$counter = 0;
		foreach ($student_scholarship_quiz_passers as $passer) {
			$counter += 1;
			$name = $passer->student->last_name.', '.$passer->student->first_name.' '.$passer->student->middle_name;
			$passers[$counter] = $name;
		}

		foreach ($applicant_scholarship_quiz_passers as $passer) {
			$counter += 1;
			$name = $passer->applicant->last_name.', '.$passer->applicant->first_name.' '.$passer->applicant->middle_name;
			$passers[$counter] = $name;
		}

		asort($passers);

		return View::make('user.scholarship.passers')
		   		   ->with('passers', $passers);
	}

	/**
	 * Store a newly created resource in student storage.
	 *
	 * @return Response
	 */
	public function storeStudent()
	{
		if (Auth::attempt(['username'=>Input::get('student_number'), 'password'=>Input::get('password')])) {
			
			$scholarship_info = explode("<=S=I=U=>", Input::get('scholarship_info'));
			
			$scholarship_type 	= $scholarship_info[0];
			$schedule 			= $scholarship_info[1];

			// return $scholarship_type;
			// S: GET REQUIRED DETAILS FOR VALIDATION
	    	$student 		= Student::where('student_number', '=', Input::get('student_number'))
	    					  		 ->first();

			$scholarship 	= ScholarshipQuiz::find($scholarship_type);
		    // E: GET REQUIRED DETAILS FOR VALIDATION

			// S: CHECK IF ALL QUESTION HAS ATLEAST 1 CORRECT ANSWER	
			//$validator = ScholarshipQuiz::validate($scholarship, $quiz_id);
			// E: CHECK IF ALL QUESTION HAS ATLEAST 1 CORRECT ANSWER	

			// S: CHECK IF STUDENT ALREADY HAVE A RESULT
			$scholarship_quiz = StudentScholarshipQuizResult::where('student_id', '=', $student->id)
                                                            ->where('school_year', '=', $scholarship->school_year)
                                                            ->with('quiz_schedule')
                                                            ->first();	
			// E: CHECK IF STUDENT ALREADY HAVE A RESULT
                                          	
			// S: CHECK IF STUDENT IS CURRENTLY TAKING A QUIZ
			$scholarship_taken = StudentScholarship::isCurrentlyTaking($student->id, 
																	   $scholarship->school_year);
			// S: CHECK IF STUDENT IS CURRENTLY TAKING A QUIZ

			if ($scholarship_quiz != "" and $scholarship_quiz->procedure == 'pass') {
				return Redirect::to('user/scholarship/quiz/student/'.$scholarship_quiz->id.'/result');				  		   
			} elseif (($scholarship_quiz != "" and $scholarship_quiz->procedure == 'register' and $scholarship_quiz->quiz_schedule->allow_to_take == 0) or 
					  ($scholarship_quiz != "" and ($scholarship_quiz->procedure == 'register' or $scholarship_quiz->procedure == 'take') and $scholarship_quiz->quiz_schedule->allow_to_take == 1 and Session::get('exam_station_mode') == null)) {
				return Redirect::to('scholarship/student/'.$scholarship_quiz->id.'/validation');	
			} elseif ($scholarship_quiz != "" and $scholarship_quiz->procedure == 'register' and $scholarship_quiz->quiz_schedule->allow_to_take == 1 and Session::get('exam_station_mode') != null) {
		        $scholarship_quiz = StudentScholarshipQuizResult::find($scholarship_quiz->id);
		        $scholarship_quiz->date_started 	= DB::raw('CURRENT_TIMESTAMP');
		        $scholarship_quiz->procedure 		= 'take';
		        $scholarship_quiz->save();

				return Redirect::to('scholarship/quiz/student/'.$scholarship_quiz->id);
			} elseif ($scholarship_taken == false) {
			    // S: MERGE THE RETURN DATA TO INPUT
				if ($student and $scholarship) {
			    	Input::merge(array(		    
			    		'student_id'	=> $student->id,
			    		'school_year'	=> $scholarship->school_year
			    	));
			    }
			    // E: MERGE THE RETURN DATA TO INPUT

				$validator = StudentScholarshipQuizResult::validate(Input::all());

				$has_available_slot = QuizSchedule::has_available_slot($schedule);

			    if ($validator->passes() and $has_available_slot == true) {
			    	$validation_key = rand(10000, 99999);

			        $result = new StudentScholarshipQuizResult(array(
			         	'student_id' 		=> $student->id,
			         	'scholarship_id' 	=> $scholarship->scholarship_id,
			         	'quiz_id' 			=> $scholarship->quiz_id,
			         	'quiz_schedule_id' 	=> $schedule,
			         	'school_year' 		=> $scholarship->school_year,
			         	'validation_key'	=> $validation_key
			        ));
			        $result->save();
			        
			    	// S: DECREMENT AVAILABLE SLOTS ON SELECTED SCHEDULE
		            $schedule           	= QuizSchedule::find($schedule);
		            $schedule->registered 	= $schedule->registered + 1;
		            $schedule->save();
		            // E: DECREMENT AVAILABLE SLOTS ON SELECTED SCHEDULE

					// FOR EXAMINATION
					return Redirect::to('scholarship/student/'.$result->id.'/validation');	
			    } else {
			    	if ($has_available_slot == false) {
				        Session::flash('message', 'No more slot available.');
				        Session::flash('class', 'alert-danger');
			    	}

			        return Redirect::to('scholarship#student')
			        			   ->withErrors($validator)
			        			   ->withInput();
			    }
			} else {
				return $scholarship_taken;
			}
		} else {
	        Session::flash('message', 'Incorrect username or password.');
	        Session::flash('class', 'alert-danger');

	        return Redirect::to('scholarship#student')
	        	   		   ->withInput();			
		} 
	}

	/**
	 * Store a newly created resource in applicant storage.
	 *
	 * @return Response
	 */
	public function storeApplicant()
	{
		$scholarship_info = explode("<=S=I=U=>", Input::get('scholarship_info'));
		
		$scholarship_type 	= $scholarship_info[0];
		$schedule 			= $scholarship_info[1];

		// S: GET REQUIRED DETAILS FOR VALIDATION
		$applicant 	= Applicant::where('first_name', '=', Input::get('first_name'))
							   ->where('last_name', '=', Input::get('last_name'))
							   ->where('middle_name', '=', Input::get('middle_name'))
						   	   ->first();
						   	   
		$applicant_id 	= ($applicant != null ? $applicant->id : null);	  		   	
		$scholarship 	= ScholarshipQuiz::find($scholarship_type);
	    // E: GET REQUIRED DETAILS FOR VALIDATION

		// S: CHECK IF APPLICANT ALREADY HAVE A RECORD AND CHECK IF CURRENTLY TAKING A QUIZ
		//	  ELSE ADD
		if ($applicant_id != null) {
			// S: CHECK IF APPLICANT ALREADY HAVE A RESULT
			$scholarship_quiz = ApplicantScholarshipQuizResult::where('applicant_id', '=', $applicant->id)
	                                                          ->where('school_year', '=', $scholarship->school_year)
                                                              ->with('quiz_schedule')
	                                                          ->first();		
			// E: CHECK IF APPLICANT ALREADY HAVE A RESULT

			$scholarship_taken = ApplicantScholarshipQuizResult::isCurrentlyTaking($applicant_id, 
																		   		   $scholarship->school_year);
		} else {
	        $applicant = new Applicant(array(
	         	'first_name' 	=> Input::get('first_name'),
	         	'last_name' 	=> Input::get('last_name'),
	         	'middle_name' 	=> Input::get('middle_name'),
	         	'contact' 		=> Input::get('contact'),
	         	'email'			=> Input::get('email')
	        ));
	        $applicant->save();

	        $applicant_id = $applicant->id;

			$scholarship_taken 	= false;
			$scholarship_quiz	= "";
		}

		// E: CHECK IF APPLICANT ALREADY HAVE A RECORD AND CHECK IF CURRENTLY TAKING A QUIZ
		//	  ELSE ADD
		// if ($scholarship_quiz != "" and $scholarship_quiz->validation_key != null) {
		// 	return Redirect::to('user/scholarship/quiz/applicant/'.$scholarship_quiz->id.'/result');

		if ($scholarship_quiz != "" and $scholarship_quiz->procedure == 'pass') {
			return Redirect::to('user/scholarship/quiz/applicant/'.$scholarship_quiz->id.'/result');				  		   
		} elseif (($scholarship_quiz != "" and $scholarship_quiz->procedure == 'register' and $scholarship_quiz->quiz_schedule->allow_to_take == 0) or 
				  ($scholarship_quiz != "" and ($scholarship_quiz->procedure == 'register' or $scholarship_quiz->procedure == 'take') and $scholarship_quiz->quiz_schedule->allow_to_take == 1 and Session::get('exam_station_mode') == null)) {
			return Redirect::to('scholarship/applicant/'.$scholarship_quiz->id.'/validation');	
		} elseif ($scholarship_quiz != "" and $scholarship_quiz->procedure == 'register' and $scholarship_quiz->quiz_schedule->allow_to_take == 1 and Session::get('exam_station_mode') != null) {
		    $scholarship_quiz = ApplicantScholarshipQuizResult::find($scholarship_quiz->id);
		    $scholarship_quiz->date_started 	= DB::raw('CURRENT_TIMESTAMP');
		    $scholarship_quiz->procedure 		= 'take';
		    $scholarship_quiz->save();

			return Redirect::to('scholarship/quiz/applicant/'.$scholarship_quiz->id);
		} elseif ($scholarship_taken == false) {
		    // S: MERGE THE RETURN DATA TO INPUT
			if ($scholarship) {
		    	Input::merge(array(		    
		    		'applicant_id'	=> $applicant_id,
		    		'school_year'	=> $scholarship->school_year
		    	));
		    }
		    // E: MERGE THE RETURN DATA TO INPUT

			$validator = ApplicantScholarshipQuizResult::validate(Input::all());

			$has_available_slot = QuizSchedule::has_available_slot($schedule);

		    if ($validator->passes() and $has_available_slot == true) {
			    $validation_key = rand(10000, 99999);

		        $result = new ApplicantScholarshipQuizResult(array(
		         	'applicant_id' 		=> $applicant_id,
		         	'scholarship_id' 	=> $scholarship->scholarship_id,
		         	'quiz_id' 			=> $scholarship->quiz_id,
		         	'quiz_schedule_id' 	=> $schedule,
		         	'school_year' 		=> $scholarship->school_year,
		         	'validation_key'	=> $validation_key
		        ));
		        $result->save();

		    	// S: INCREMENT REGISTERED ON SELECTED SCHEDULE
	            $schedule           	= QuizSchedule::find($schedule);
	            $schedule->registered 	= $schedule->registered + 1;
	            $schedule->save();
	            // E: INCREMENT REGISTERED ON SELECTED SCHEDULE

	            return Redirect::to('scholarship/applicant/'.$result->id.'/validation');	
		    } else {
		    	if ($has_available_slot == false) {
			        Session::flash('message', 'No more slot available.');
			        Session::flash('class', 'alert-danger');
		    	}

		        return Redirect::to('scholarship#applicant')
		        			   ->withErrors($validator)
		        			   ->withInput();
		    }
		} else {
			return $scholarship_taken;
		}
	}

	public function validation($user, $scholarship_quiz_id)
	{
		if($user == 'student') {
			$user_result_model 	= 'StudentScholarshipQuizResult';
		} else {
			$user_result_model 	= 'ApplicantScholarshipQuizResult';
		}

		$validation_info = $user_result_model::where('id', '=', $scholarship_quiz_id)
											 ->with(array($user,
											 			  'quiz_schedule',  
														  'scholarship'))
										  	 ->first();

		return View::make('user.scholarship.validation')
				   ->with('user', $user)
				   ->with('validation_info', $validation_info);
	}

	public function validationQuiz()
	{

		$validation_key = Input::get('validation_key');

		$student_scholarship_quiz_result = StudentScholarshipQuizResult::where('validation_key', '=', $validation_key)
									     ->first();

		$applicant_scholarship_quiz_result = ApplicantScholarshipQuizResult::where('validation_key', '=', $validation_key)
										   ->first();

		if (count($student_scholarship_quiz_result) + count($applicant_scholarship_quiz_result) == 0) {
	        Session::flash('message', 'Invalid validation key.');
	        Session::flash('class', 'alert-danger');

	        return Redirect::to('scholarship');	
		}

		if ($student_scholarship_quiz_result) {
			// S: CHECK IF STUDENT ALREADY HAVE A RESULT
			$scholarship_quiz = StudentScholarshipQuizResult::where('student_id', 	'=', $student_scholarship_quiz_result->student_id)
                                                            ->where('school_year', 	'=', $student_scholarship_quiz_result->school_year)
                                                            ->with('quiz_schedule')
                                                            ->first();	
			// E: CHECK IF STUDENT ALREADY HAVE A RESULT
                                          	
			// S: CHECK IF STUDENT IS CURRENTLY TAKING A QUIZ
			$scholarship_taken = StudentScholarship::isCurrentlyTaking($student_scholarship_quiz_result->student_id, 
																	   $student_scholarship_quiz_result->school_year);
			// S: CHECK IF STUDENT IS CURRENTLY TAKING A QUIZ

			// return $scholarship_quiz;

			if ($scholarship_quiz != "" and $scholarship_quiz->procedure == 'pass') {
				return Redirect::to('user/scholarship/quiz/student/'.$scholarship_quiz->id.'/result');				  		   
			} elseif (($scholarship_quiz != "" and $scholarship_quiz->procedure == 'register' and $scholarship_quiz->quiz_schedule->allow_to_take == 0) or 
					  ($scholarship_quiz != "" and ($scholarship_quiz->procedure == 'register' or $scholarship_quiz->procedure == 'take') and $scholarship_quiz->quiz_schedule->allow_to_take == 1 and Session::get('exam_station_mode') == null)) {
				return Redirect::to('scholarship/student/'.$scholarship_quiz->id.'/validation');	
			} elseif ($scholarship_quiz != "" and $scholarship_quiz->procedure == 'register' and $scholarship_quiz->quiz_schedule->allow_to_take == 1 and Session::get('exam_station_mode') != null) {
		        $scholarship_quiz = StudentScholarshipQuizResult::find($scholarship_quiz->id);
		        $scholarship_quiz->date_started 	= DB::raw('CURRENT_TIMESTAMP');
		        $scholarship_quiz->procedure 		= 'take';
		        $scholarship_quiz->save();

				return Redirect::to('scholarship/quiz/student/'.$scholarship_quiz->id);
			} else {
				return $scholarship_taken;
			}
		} else {
			// S: CHECK IF STUDENT ALREADY HAVE A RESULT
			$scholarship_quiz = ApplicantScholarshipQuizResult::where('applicant_id', 	'=', $applicant_scholarship_quiz_result->applicant_id)
                                                              ->where('school_year', 	'=', $applicant_scholarship_quiz_result->school_year)
                                                              ->with('quiz_schedule')
                                                              ->first();	
			// E: CHECK IF STUDENT ALREADY HAVE A RESULT
                                          	
			// S: CHECK IF STUDENT IS CURRENTLY TAKING A QUIZ
			$scholarship_taken = ApplicantScholarshipQuizResult::isCurrentlyTaking($applicant_scholarship_quiz_result->applicant_id, 
																	   			   $applicant_scholarship_quiz_result->school_year);
			// S: CHECK IF STUDENT IS CURRENTLY TAKING A QUIZ

			if ($scholarship_quiz != "" and $scholarship_quiz->procedure == 'pass') {
				return Redirect::to('user/scholarship/quiz/applicant/'.$scholarship_quiz->id.'/result');				  		   
			} elseif (($scholarship_quiz != "" and $scholarship_quiz->procedure == 'register' and $scholarship_quiz->quiz_schedule->allow_to_take == 0) or 
					  ($scholarship_quiz != "" and ($scholarship_quiz->procedure == 'register' or $scholarship_quiz->procedure == 'take') and $scholarship_quiz->quiz_schedule->allow_to_take == 1 and Session::get('exam_station_mode') == null)) {
				return Redirect::to('scholarship/applicant/'.$scholarship_quiz->id.'/validation');	
			} elseif ($scholarship_quiz != "" and $scholarship_quiz->procedure == 'register' and $scholarship_quiz->quiz_schedule->allow_to_take == 1 and Session::get('exam_station_mode') != null) {
			    $scholarship_quiz = ApplicantScholarshipQuizResult::find($scholarship_quiz->id);
			    $scholarship_quiz->date_started 	= DB::raw('CURRENT_TIMESTAMP');
			    $scholarship_quiz->procedure 		= 'take';
			    $scholarship_quiz->save();

				return Redirect::to('scholarship/quiz/applicant/'.$scholarship_quiz->id);
			} else {
				return $scholarship_taken;
			}
		}
	}
}