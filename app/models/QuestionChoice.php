<?php

class QuestionChoice extends Eloquent {
	protected $table = 'question_choice';
	protected $fillable = array('question_id', 'choice_id', 'answer');

	public $timestamps 	= false;

	public function question()
	{
		return $this->belongsTo('Question','question_id');
	}

	public function choice()
	{
		return $this->belongsTo('Choice','choice_id');
	}
}