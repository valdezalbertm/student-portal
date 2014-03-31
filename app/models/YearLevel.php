<?php

class YearLevel extends Eloquent {
	protected $table 	= 'year_level';
	public $timestamps 	= false;
	protected $guarded = array();

	public static $rules = array();
}
