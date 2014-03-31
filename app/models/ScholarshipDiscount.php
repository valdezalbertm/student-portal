<?php

class ScholarshipDiscount extends Eloquent {
	protected $table 	= 'scholarship_discount';
	public $timestamps 	= false;
	protected $guarded = array('id');

	/**
		Relations
	*/
    public function scholarship()
    {
        return $this->belongsTo('Scholarship');
    }
}
