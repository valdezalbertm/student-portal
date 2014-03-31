<?php

class AccountType extends Eloquent {
    protected $table    = 'account_type';
    public $timestamps  = false;
    protected $guarded = array();

    public static $rules = array();

    /**
        Relations
    */
    public function accounts()
    {
        return $this->hasMany('Account');
    }
}
