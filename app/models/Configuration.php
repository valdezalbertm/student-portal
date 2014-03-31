<?php

class Configuration extends Eloquent {
	protected $table 	= 'config';
	public $timestamps 	= false;
	protected $guarded = array();

	public static $rules = array();
}
