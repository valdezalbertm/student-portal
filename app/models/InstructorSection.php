<?php

class InstructorSection extends Eloquent {
	protected $table 	= 'instructor_section';
	public $timestamps 	= false;
	protected $guarded = array();

	public static $rules = array();
}
