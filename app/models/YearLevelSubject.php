<?php

class YearLevelSubject extends Eloquent {
	protected $table 	= 'year_level_subject';
	public $timestamps 	= false;
	protected $guarded = array();

	public static $rules = array();
}
