<?php

class Student extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	public $timestamps = false;
	protected $table = 'student';

	public static function get_yr_list()
	{
		$yrs = DB::table('year_level')->get();
		$yr = array();
		foreach($yrs as $temp) {
			$yr = array_add($yr, $temp->id, $temp->name);
		}

		return $yr;
	}

	public static function stud_exist($id)
    {
        $ctr = Student::where('id', $id)->count();

        if ($ctr == 1) {
            return true;
        } else {
            return false;
        }
    }
    
	/**
		Relations
	*/
    public function account()
    {
        return $this->belongsTo('Account','id');
    }

    public function penalty()
    {
        return $this->hasMany('StudentPenalty');
    }

    public function scholarship()
    {
        return $this->hasMany('StudentScholarship','student_id');
    }

    public static function add_student_subject($stud_id)
    {
        for ($i=0; $i < 32; $i++) {
            DB::table('student_grade')->insert([
                'student_id' => $stud_id,
                'year_level_id' => (int)($i/8)+1,
                'subject_id' => $i+1,
                'school_year' => 1
            ]);
        }
    }

}