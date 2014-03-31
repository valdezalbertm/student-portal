<?php

class Scholarship extends Eloquent {
	protected $table 	= 'scholarship';
	public $timestamps 	= false;
	protected $guarded = array();

    public static $rules = array(
        'name'       => 'required|max:80'
        );

	/**
		Relations
	*/
    public function discount()
    {
        return $this->hasMany('ScholarshipDiscount');
    }

    public function scholarship_discount()
    {
        return $this->hasMany('ScholarshipDiscount', 'scholarship_id');
    }
    
    public function scholarship_quiz()
    {
        return $this->hasMany('ScholarshipQuiz', 'quiz_id');
    }

    public function student_scholarship_quiz_result()
    {
        return $this->hasMany('StudentScholarshipQuizResult', 'quiz_id');
    }
}
