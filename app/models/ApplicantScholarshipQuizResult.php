<?php

class ApplicantScholarshipQuizResult extends Eloquent {
	protected $table 	= 'applicant_scholarship_quiz_result';
	protected $fillable = array('applicant_id', 
								'scholarship_id', 
								'quiz_id', 
								'quiz_schedule_id',
								'score', 
								'overall', 
								'date_started', 
								'school_year', 
								'validation_key',
								'procedure', 
								'is_pass');

	public $timestamps 	= false;

	public function applicant()	
	{
		return $this->belongsTo('Applicant','applicant_id');
	}

	public function scholarship()
	{
		return $this->belongsTo('Scholarship','scholarship_id');
	}

	public function quiz()
	{
		return $this->belongsTo('Quiz','quiz_id');
	}

	public function quiz_schedule() {
		return $this->belongsTo('QuizSchedule','quiz_schedule_id');
	}
	
    public static function isCurrentlyTaking($applicant_id, $school_year) {
        $scholarhip_quiz    = ApplicantScholarshipQuizResult::where('applicant_id', '=', $applicant_id)
        													->where('school_year', '=', $school_year)
                                                            ->with('quiz')
                                                            ->first();

        if ($scholarhip_quiz != null and $scholarhip_quiz->procedure == 'take' and Session::get('exam_station_mode') != null) {
            $time_limit     = $scholarhip_quiz->quiz->time_limit;
            $date_started   = strtotime($scholarhip_quiz->date_started);
                            
            $time_remaining = $date_started - (time() - $time_limit * 60);

            if ($time_remaining > 0) {
                return Redirect::to('scholarship/quiz/applicant/'.$scholarhip_quiz->id);   
            }                                          
        }   
        
        return false;
    }

	public static function validate($input)
	{
	    $rules = array(
	    	'applicant_id'		=> 'unique:applicant_scholarship_quiz_result,applicant_id,NULL,id,school_year,'.$input['school_year'],
	    	'first_name'		=> 'Required',
	    	'middle_name'		=> 'Required',
	    	'last_name'			=> 'Required',
			'scholarship_info'  => 'Required'
	    );

		$messages = array(
		    'applicant_id.unique' => 'You already applied scholarship on school year '.$input['school_year'] ,
		);

	    return Validator::make($input, $rules, $messages);
	}

	public static function isPass($pass, $display, $negate)
	{
		if($negate == false) {
			if($pass == 1) {
				return ($display == 'text') ? 'true' : '<span class="correct answer-icon"><i class="fa fa-check"></i></span>';
			} else {
				return ($display == 'text') ? 'false' : '<span class="wrong answer-icon"><i class="fa fa-times"></i></span>';
			}
		} else {
			if($pass == 1) {
				return ($display == 'text') ? 'false' : '<span class="wrong answer-icon"><i class="fa fa-times"></i></span>';
			} else {
				return ($display == 'text') ? 'true' : '<span class="correct answer-icon"><i class="fa fa-check"></i></span>';	
			}
		}

	}
}
