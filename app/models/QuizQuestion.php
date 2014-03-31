<?php

class QuizQuestion extends Eloquent {
	protected $table = 'quiz_question';
	protected $fillable = array('quiz_id', 'question_id', 'subject_id');

	public $timestamps 	= false;

	public function quiz()
	{
		return $this->belongsTo('Quiz','quiz_id');
	}

	public function question()
	{
		return $this->belongsTo('Question','question_id');
	}

	public function subject()
	{
		return $this->belongsTo('Subject','subject_id');
	}
	
	public static function validate($input)
	{
	    $rules = array(
	        'content'  			=> 'Required',
	        'question_type_id' 	=> 'Required'
	    );

	    return Validator::make($input, $rules);
	}
}