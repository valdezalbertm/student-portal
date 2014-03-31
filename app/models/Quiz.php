<?php

class Quiz extends Eloquent {
	protected $table = 'quiz';
	protected $fillable = array('title', 'instruction', 'description', 'time_limit');
	
	public $timestamps 	= false;
	
	public function quiz_question()
	{
		return $this->hasMany('QuizQuestion', 'quiz_id');
	}

    public function scholarship_quiz()
    {
        return $this->hasMany('ScholarshipQuiz', 'quiz_id');
    }

    public function student_scholarship_quiz_result()
    {
        return $this->hasMany('StudentScholarshipQuizResult', 'quiz_id');
    }

	public function quiz_schedule()
	{
		return $this->hasMany('QuizSchedule','quiz_id');
	}

	public static function validate($input)
	{
	    $rules = array(
			'title' 		=> 'Required',
	        'description'  	=> 'Required',
	        'instruction'  	=> 'Required',
	        'time_limit'  	=> 'Required|Integer'
	    );

	    return Validator::make($input, $rules);
	}
}