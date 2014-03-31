<?php

class StudentScholarshipQuizAnswer extends Eloquent {
	protected $table 	= 'student_scholarship_quiz_answer';
	protected $fillable = array('question_id', 'answer', 'correct');

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
