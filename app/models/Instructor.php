<?php

class Instructor extends Eloquent {
	protected $table 	= 'instructor';
	public $timestamps 	= false;
	protected $guarded = array();

	public static $rules = array();

	/**
		Relations
	*/
    public function account()
    {
        return $this->belongsTo('Account','id');
    }
}
