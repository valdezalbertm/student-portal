<?php

class QuizSchedule extends Eloquent {
	protected $table 	= 'quiz_schedule';
	protected $fillable = array('quiz_id', 
								'from', 
								'to', 
								'slots', 
								'registered', 
								'allow_to_take');

	public $timestamps 	= false;

	public function quiz()
	{
		return $this->belongsTo('Quiz','quiz_id');
	}

	public function student_scholarship_quiz_result() {
		return $this->hasMany('StudentScholarshipQuizResult','quiz_schedule_id');
	}

	public function applicant_scholarship_quiz_result() {
		return $this->hasMany('ApplicantScholarshipQuizResult','quiz_schedule_id');
	}

	public static function validate($input)
	{
	    $rules = array(
			'from' 	=> 'Required|date|after:'.date('Y-m-d H:i:s'),
	        'to'	=> 'Required|date|after:'.$input['from'],
	        'slots' => 'Required|Integer'
	    );

		$messages = array(
		    'from.after' => 'The start of examination must be a date after your current time.',
		    'to.after' => 'The end of examination must be a date after the start of examination'
		);

	    return Validator::make($input, $rules, $messages);
	}

	public static function has_available_slot($id)
	{
		$schedule = QuizSchedule::find($id);	

		if ($schedule->slots - $schedule->registered > 0) {
			return true;
		} else {
			return false;
		}
	}
}
	