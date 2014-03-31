<?php

class Announcement extends Eloquent {
	protected $fillable = ['*'];
	public static $rules = array();

	public $timestamps = false;
	protected $table = 'announcement';

}