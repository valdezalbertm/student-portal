<?php

class Subject extends Eloquent {

	protected $guarded = array();
	protected $fillable = ['id', 'name'];
	public static $rules = array();
	public $timestamps = false;
	protected $table = 'subject';

    public function quiz_question()
    {
        return $this->hasMany('QuizQuestion', 'subject_id');
    }


    public static function subj_exist($id)
    {
        $ctr = Subject::where('id', $id)->count();

        if ($ctr == 1) {
            return true;
        } else {
            return false;
        }
    }
}