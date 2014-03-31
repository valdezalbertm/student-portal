<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Account extends Eloquent implements UserInterface, RemindableInterface {

    protected $table = 'account';
    protected $hidden = array('password');
    public $timestamps = false;

    /* Logout user, clear all. */
    public static function logout_user()
    {
        /* Flush everything, leave no trace. */
        Cache::forget('user_id');
        Cache::forget('username');
        Cache::forget('hash_key');
        Cache::forget('account_type');
        Cache::forget('last_login');
        Cache::forget('remember');
        Session::flush();
    }

    /* Check admin session */
    public static function check_admin_session()
    {
        // check session hold by user
        $user = DB::table('vw_account_list')
            ->where('id', Session::get('user_id'))
            ->where('username', Session::get('username'))
            ->where('hash_key', Session::get('hash_key'))
            ->where('type', Session::get('account_type'))
            //->where('type', 'Administrator')
            ->count();

        if ($user == 1) {
            //generate new session_key

            return true;
        } else {
            Session::put('redirect_to', Request::url());

            Session::flash('message', 'Session expired. Please login to continue.');
            Session::flash('class', 'alert-danger');

            return false;
        }
    }

    /* Check if current account is Admin or Professor */
    public static function check_admin_prof_session()
    {
        // check session hold by user
        $user = DB::table('vw_account_list')
            ->where('id', Session::get('user_id'))
            ->where('username', Session::get('username'))
            ->where('hash_key', Session::get('hash_key'))
            ->where('type', Session::get('account_type'))
            ->where(function($query) {
                $query->where('type', 'Administrator')
                      ->orWhere('type', 'Instructor');
            })->count();

        if ($user == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getReminderEmail()
    {
        return $this->email;
    }

    public function student()
    {
        return $this->hasOne('Student','id');
    }
}