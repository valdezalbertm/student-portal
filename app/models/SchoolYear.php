<?php

class SchoolYear extends Eloquent {
	protected $table 	= 'school_year';
	public $timestamps 	= false;
	protected $guarded = array();

	public static $rules = array();
}
