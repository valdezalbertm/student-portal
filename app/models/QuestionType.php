<?php

class QuestionType extends Eloquent {
	protected $table = 'question_type';
	protected $fillable = array('title', 'content', 'answer', 'question_type_id');

	public $timestamps 	= false;

	public function question()
	{
		return $this->hasMany('QuizQuestion','question_type_id');
	}
}