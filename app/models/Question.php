<?php

class Question extends Eloquent {
	protected $table = 'question';
	protected $fillable = array('content', 'question_type_id');

	public $timestamps 	= false;

	public function quiz_question()
	{
		return $this->hasMany('QuizQuestion','question_id');
	}

	public function question_choice()
	{
		return $this->hasMany('QuestionChoice','question_id');
	}

	public function student_scholarship_quiz_answer() 
	{
		return $this->hasOne('StudentScholarshipQuizAnswer', 'question_id');
	}

	public function applicant_scholarship_quiz_answer() 
	{
		return $this->hasOne('ApplicantScholarshipQuizAnswer', 'question_id');
	}

	public function question_type()
	{
		return $this->belongsTo('QuestionType', 'question_type_id');
	}

	public static function isCorrect($answer, $display, $negate)
	{
		if($negate == false) {
			if($answer == 1) {
				return ($display == 'text') ? 'true' : '<span class="correct answer-icon"><i class="fa fa-check"></i></span>';
			} else {
				return ($display == 'text') ? 'false' : '<span class="wrong answer-icon"><i class="fa fa-times"></i></span>';
			}
		} else {
			if($answer == 1) {
				return ($display == 'text') ? 'false' : '<span class="wrong answer-icon"><i class="fa fa-times"></i></span>';
			} else {
				return ($display == 'text') ? 'true' : '<span class="correct answer-icon"><i class="fa fa-check"></i></span>';	
			}
		}

	}
}