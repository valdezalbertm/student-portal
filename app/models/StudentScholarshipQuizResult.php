<?php

class StudentScholarshipQuizResult extends Eloquent {
	protected $table 	= 'student_scholarship_quiz_result';
	protected $fillable = array('student_id', 
								'scholarship_id', 
								'quiz_id', 
								'quiz_schedule_id',
								'score', 
								'overall', 
								'date_started', 
								'school_year', 
								'validation_key', 
								'procedure', 
								'is_pass');

	public $timestamps 	= false;

	public function student()	
	{
		return $this->belongsTo('Student','student_id');
	}

	public function scholarship()
	{
		return $this->belongsTo('Scholarship','scholarship_id');
	}

	public function quiz()
	{
		return $this->belongsTo('Quiz','quiz_id');
	}

	public function quiz_schedule() {
		return $this->belongsTo('QuizSchedule','quiz_schedule_id');
	}

	public static function validate($input)
	{
	    $rules = array(
			'student_id' 		=> 'unique:student_scholarship_quiz_result,student_id,NULL,id,school_year,'.$input['school_year'],
			'student_number' 	=> 'Required|Exists:student',
			'scholarship_info'  => 'Required'
	    );

		$messages = array(
		    'student_id.unique' => 'You already applied scholarship on school year '.$input['school_year'] ,
		);

	    return Validator::make($input, $rules, $messages);
	}

	public static function isPass($pass, $display, $negate)
	{
		if($negate == false) {
			if($pass == 1) {
				return ($display == 'text') ? 'true' : '<span class="correct answer-icon"><i class="fa fa-check"></i></span>';
			} else {
				return ($display == 'text') ? 'false' : '<span class="wrong answer-icon"><i class="fa fa-times"></i></span>';
			}
		} else {
			if($pass == 1) {
				return ($display == 'text') ? 'false' : '<span class="wrong answer-icon"><i class="fa fa-times"></i></span>';
			} else {
				return ($display == 'text') ? 'true' : '<span class="correct answer-icon"><i class="fa fa-check"></i></span>';	
			}
		}

	}
}
