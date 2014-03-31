<?php

class ScholarshipQuizResult extends Eloquent {
	protected $table 	= 'scholarship_quiz_result';
	protected $fillable = array('student_id', 'scholarship_id', 'quiz_id', 'score', 'date_started', 'schoolyear');

	public $timestamps 	= false;

	public function scholarship()
	{
		return $this->belongsTo('Scholarship','scholarship_id');
	}

	public function quiz()
	{
		return $this->belongsTo('Quiz','quiz_id');
	}
}
