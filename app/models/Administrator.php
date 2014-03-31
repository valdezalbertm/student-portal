<?php

class Administrator extends Eloquent {
	protected $guarded = array();
	protected $fillable = ['username', 'account_type', 'password'];
	public static $rules = array();

	public $timestamps = false;
	protected $table = 'account';

	public static function login_user()
	{
		$username = Input::get('username');
		$password = Hash::make(Input::get('password'));

		/* check password provided first */
		$p = DB::table('account')->select('password')->where('username',  $username)->first();
		if ( ! Hash::check('123', $p->password)) {
			return false;
		}

		/* count the number of user with un */
		$count = DB::table('account')
			->where('username', $username)
			->count();

		if ($count == 1) {
			/* generate (new) session key to save to db and save to user */
			$sess = md5(rand());

			/* get account_type */
			$acc_type = DB::table('vw_account_list')
				->select('id', 'type', 'last_login')
				->where('username', $username)
				->first();

			/* S: Set Session */
			Session::put('user_id', $acc_type->id);
			Session::put('username', $username);
			Session::put('hash_key', $sess);
			Session::put('account_type', $acc_type->type);
			Session::put('last_login', $acc_type->last_login);

			/* S: Set Cookie */
			Cache::put('user_id', $acc_type->id, '31536000');
			Cache::put('hash_key', $sess, '31536000');
			Cache::put('username', $username, '31536000');
			Cache::put('account_type', $acc_type->type, '31536000');
			Cache::put('last_login', $acc_type->last_login, '31536000');

			/* add remember-me if checked */
			if (Input::get('remember') == 'remember-me') {
				Cache::put('remember', 'YES', '31536000');
			} else {
				Cache::forget('remember');
			}

			/* save cache to database and update last login */
			DB::table('account')->where('username', $username)->update( ['hash_key' => $sess, 'last_login' => date('Y-m-d h:m:s')] );

			return true;
		} else {
			return false;
		}
	}

	public static function check_cookie()
	{
		// check session hold by user
		$user = DB::table('vw_account_list')
			->where('id', Cache::get('user_id'))
			->where('username', Cache::get('username'))
			->where('hash_key', Cache::get('hash_key'))
			->where('type', Cache::get('account_type'))
			//->where('type', 'Administrator')
			->count();

		if ($user == 1) {
			return true;
		} else {
			return false;
		}
	}

	public static function generate_hash_key()
	{
		/* Generate (new) session key to save to db and save to user */
		$sess = md5(rand());

		/* S: Set Session and Cache */
		Session::put('hash_key', $sess);
		Cache::put('hash_key', $sess, '31536000');
		/* E: Set Session and Cache */

		/* save cache to database and update last login */
		DB::table('account')->where('username', Cache::get('username'))->update( ['hash_key' => $sess, 'last_login' => date('Y-m-d h:m:s')] );
	}

	public static function generate_new_session()
	{
		/* Generate (new) session key to save to db and save to user */
		$sess = md5(rand());

		//get account_type
		$user = DB::table('vw_account_list')
			->select('id', 'username', 'type', 'last_login')
			->where('id', Cache::get('user_id'))
			->where('username', Cache::get('username'))
			->first();

		/* S: Set Session */
		Session::put('user_id', $user->id);
		Session::put('username', $user->username);
		Session::put('hash_key', $sess);
		Session::put('account_type', $user->type);
		Session::put('last_login', $user->last_login);
		/* E: Set Session */

		/* S: Set Cookie */
		Cache::put('user_id', $user->id, '31536000');
		Cache::put('hash_key', $sess, '31536000');
		Cache::put('username', $user->username, '31536000');
		Cache::put('account_type', $user->type, '31536000');
		Cache::put('last_login', $user->last_login, '31536000');
		/* E: Set Cookie */

		/* save cache to database and update last login */
		DB::table('account')->where('username', Cache::get('username'))->update( ['hash_key' => $sess, 'last_login' => date('Y-m-d h:m:s')] );
	}

	public static function get_account_type($id)
	{
		$acc = DB::table('account')->select('account_type_id as account_type')->where('id', $id)->first();
		return $acc->account_type;
	}

	public static function prof_count()
	{
		$count = DB::table('vw_professor_list')->count();

		return $count;
	}

	public static function stud_count()
	{
		$count = DB::table('vw_student_list')->count();

		return $count;
	}

	public static function user_count()
	{
		$count = DB::table('vw_account_list')->count();

		return $count;
	}

	public static function login_user_revised()
	{
		$username = Input::get('username');

		/* generate (new) session key to save to db and save to user */
        $sess = md5(rand());

        /* get account_type */
        $acc_type = DB::table('vw_account_list')
            ->select('id', 'type', 'last_login')
            ->where('username', $username)
            ->first();

        /* S: Set Session */
        Session::put('user_id', $acc_type->id);
        Session::put('username', $username);
        Session::put('hash_key', $sess);
        Session::put('account_type', $acc_type->type);
        Session::put('last_login', $acc_type->last_login);

        /* S: Set Cookie */
        Cache::put('user_id', $acc_type->id, '31536000');
        Cache::put('hash_key', $sess, '31536000');
        Cache::put('username', $username, '31536000');
        Cache::put('account_type', $acc_type->type, '31536000');
        Cache::put('last_login', $acc_type->last_login, '31536000');

        /* add remember-me if checked */
        if (Input::get('remember') == 'remember-me') {
            Cache::put('remember', 'YES', '31536000');
        } else {
            Cache::forget('remember');
        }

        /* save cache to database and update last login */
        DB::table('account')->where('username', $username)->update( ['hash_key' => $sess, 'last_login' => date('Y-m-d h:m:s')] );
	}
}
