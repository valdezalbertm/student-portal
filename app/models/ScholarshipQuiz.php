<?php

class ScholarshipQuiz extends Eloquent {
	protected $table 	= 'scholarship_quiz';
	protected $fillable = array('scholarship_id', 'quiz_id', 'school_year');

	public $timestamps 	= false;

	public function scholarship()
	{
		return $this->belongsTo('Scholarship','scholarship_id');
	}

	public function quiz()
	{
		return $this->belongsTo('Quiz','quiz_id');
	}

	public static function validate($scholarship, $quiz_id)
	{
		// S: CHECK IF SCHOLARSHIP ALREADY ASSIGNED ON QUIZ
		$scholarship_quiz = ScholarshipQuiz::where('scholarship_id', '=', $scholarship->scholarship_id)
									  	   ->where('quiz_id', '=', $quiz_id)
									  	   ->where('school_year', '=', $scholarship->school_year)
										   ->count();	

		if($scholarship_quiz != 0) {
	        Session::flash('message', $scholarship->scholarship->name.' scholarship on school year '.$scholarship->school_year.' already set on this quiz.');
	        Session::flash('class', 'alert-danger');

			return false;
		}
		// E: CHECK IF SCHOLARSHIP ALREADY ASSIGNED ON QUIZ

		// S: CHECK IF ALL QUESTION HAS ATLEAST 1 CORRECT ANSWER
		$quiz_question = QuizQuestion::where('quiz_id', '=', $quiz_id)
								 	 ->with(array('question', 
								 	 			  'question.question_choice' => function($query) { 
														$query->where('answer', '=','1');
												  }
								 	 			 )
								 	 		)
								 	 ->get();	
	
		if($quiz_question->count() == 0) {
	        Session::flash('message', 'Make sure all question on associated <a href="'. URL::to("administrator/quiz/".$quiz_id."/question") .'">Quiz</a> has atleast 1 correct answer.');
	        Session::flash('class', 'alert-danger');
			
			return false;
		} else {
			foreach ($quiz_question as $questions) {
				if($questions->question->question_choice->count() == 0) {
			        Session::flash('message', 'Make sure all question on associated <a href="'. URL::to("administrator/quiz/".$quiz_id."/question") .'">Quiz</a> has atleast 1 correct answer.');
			        Session::flash('class', 'alert-danger');
					
					return false;
				}
			}
		}
		// E: CHECK IF ALL QUESTION HAS ATLEAST 1 CORRECT ANSWER

		return true;							 
	}
}
	