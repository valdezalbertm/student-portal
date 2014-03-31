<?php

class Choice extends Eloquent {
	protected $table = 'choice';
	protected $fillable = array('content');

	public $timestamps 	= false;

	public function question()
	{
		return $this->hasMany('Question', 'answer_id');
	}

	public function question_choice()
	{
		return $this->hasMany('QuestionChoice','choice_id');
	}

	public static function validate($input)
	{
	    $rules = array(
	        'content' => 'Required'
	    );

	    return Validator::make($input, $rules);
	}
}