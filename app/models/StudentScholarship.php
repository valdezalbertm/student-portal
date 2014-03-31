<?php

class StudentScholarship extends Eloquent {
	protected $table 	= 'student_scholarship';
    protected $appends = array('discount','discount_type','name');
	public $timestamps 	= false;
	protected $guarded = array();

	public static $rules = array();

    /**
        Relations
    */
    public function student()
    {
        return $this->belongsTo('Student');
    }

    public function scholarship()
    {
        return $this->belongsTo('Scholarship');
    }

    public static function isCurrentlyTaking($student_id, $school_year) {
        $scholarhip_quiz    = StudentScholarshipQuizResult::where('student_id', '=', $student_id)
                                                          ->where('school_year', '=', $school_year)
                                                          ->with('quiz')
                                                          ->first();

        if ($scholarhip_quiz != null and $scholarhip_quiz->procedure == 'take' and Session::get('exam_station_mode') != null) {
            $time_limit     = $scholarhip_quiz->quiz->time_limit;
            $date_started   = strtotime($scholarhip_quiz->date_started);
                            
            $time_remaining = $date_started - (time() - $time_limit * 60);

            if ($time_remaining > 0) {
                return Redirect::to('scholarship/quiz/student/'.$scholarhip_quiz->id);   
            }                                          
        }   
        
        return false;
    }

    public function getDiscountAttribute()
    {
        $discount = ScholarshipDiscount::select('value')
            ->where('scholarship_id',$this->scholarship_id)
            ->where('school_year',$this->school_year)
            ->limit(1)
            ->get()->first();

        return $discount->value;
    }

    public function getDiscountTypeAttribute()
    {
        $discount = ScholarshipDiscount::select('type')
            ->where('scholarship_id',$this->scholarship_id)
            ->where('school_year',$this->school_year)
            ->limit(1)
            ->get()->first();

        return $discount->type;
    }

    public function getNameAttribute()
    {
        $scholarship = Scholarship::select('name')
            ->where('id',$this->scholarship_id)
            ->limit(1)
            ->get()->first();

        return $scholarship->name;
    }
}
