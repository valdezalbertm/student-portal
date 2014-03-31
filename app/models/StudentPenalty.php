<?php

class StudentPenalty extends Eloquent {
    protected $table    = 'student_penalty';
    public $timestamps  = false;
    protected $guarded  = array('id');

    public static $rules = array(
        'id'       => 'required|integer',
        'type'          => 'required|in:minor,major',
        'description'   => 'required|max:450',
        'date'          => 'required|date'
        );

    /**
        Relations
    */
    public function student()
    {
        return $this->belongsTo('Student','id');
    }
}
