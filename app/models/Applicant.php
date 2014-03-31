<?php

class Applicant extends Eloquent {
    protected $table    = 'applicant';
    protected $fillable = array('first_name', 'last_name', 'middle_name', 'contact', 'email');

    public $timestamps  = false;

    public function scholarship_quiz_result()
    {
        return $this->hasMany('ApplicantScholarshipQuizResult','applicant_id');
    }

}