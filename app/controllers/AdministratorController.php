<?php

class AdministratorController extends BaseController {

	public function __construct() {
        $this->beforeFilter('csrf', array('on'=>'post'));
        $this->beforeFilter('auth', array('only'=>array('create', 'edit', 'delete')));
    }

	public function index()
	{
	    //check hash_key to database and account_type
		if (Account::check_admin_session()) {
			$prof_num = Administrator::prof_count();
			$stud_num = Administrator::stud_count();
			$user_num = Administrator::user_count();
			$subj_num = Subject::all()->count();

			/* get announcement */
			$ann = Announcement::all();

			//load student data
			Auth::user()->load('student.scholarship','student.penalty');
			
			$users = DB::table('vw_account_list')->orderby('type')->get();

			return View::make('admin.index', compact('users', 'prof_num', 'stud_num', 'user_num', 'subj_num', 'ann'));
		} else {
			return View::make('admin.login');
		}
	}

	public function lists()
	{
		$users = DB::table('vw_account_list')->orderby('type')->get();
		$count = Administrator::user_count();

		return View::make('admin.list2', compact('users', 'count'));
	}

	public function account_list()
	{
		$users = DB::table('vw_account_list')->orderby('type')->get();
		return $users;
	}

	public function create()
	{
		if ( ! Account::check_admin_session()) {
			return View::make('admin.login');
		}

        return View::make('admin.create');
	}

	public function store()
	{
		$val = Validator::make(
			Input::all(),
			[
				'username'     => 'required',
				'username'     => 'unique:account,username',
				'account_type' => 'required',
				'password1'    => 'required',
				'password2'    => 'required',
				'password1'    => 'same:password2'
			]
		);

		if ($val->passes()) {
			$account                  = new Administrator;
			$account->username        = Input::get('username');
			$account->account_type_id = Input::get('account_type');
			//$account->password      = hash('sha512', Input::get('password1'));
			$account->password        = Hash::make(Input::get('password1'));
			$account->save();

			return Redirect::route('admin.index');
		} else {
			return Redirect::back()->withInput()->withErrors($val);
		}
	}

	public function show($id)
	{
		//Determine account type first
		$acc_type = Administrator::get_account_type($id);

		if ($acc_type == 1) {
			$user = DB::table('vw_account_list')->where('id', $id)->first();
        	return View::make('admin.show', compact('user'));
		} elseif ($acc_type == 2) {
			return Redirect::route('prof.show', $id);
		} elseif ($acc_type == 3) {
			return Redirect::route('stud.show', $id);
		} else {
			Redirect::route('admin.index');
		}
	}

	public function edit($id)
	{
		if ( ! Account::check_admin_session()) {
			return View::make('admin.login');
		}

		//Determine account type first
		$acc_type = Administrator::get_account_type($id);

		if ($acc_type == 1) {
			$user = Administrator::find($id);
			return View::make('admin.edit', compact('user'));
		} elseif ($acc_type == 2) {
			return Redirect::route('prof.edit', $id);
		} elseif ($acc_type == 3) {
			return Redirect::route('stud.edit', $id);
		} else {
			Redirect::route('admin.index');
		}
	}

	public function update($id)
	{
		if ( ! Account::check_admin_session()) {
			return View::make('admin.login');
		}

		$val = Validator::make(Input::all(), [
			'account_type' => 'required',
			'password1' => 'same:password2',
			'password1' => 'required:min:6',
			'password2' => 'required:min:6'
		] );

		if ($val->passes()) {
			//if no pass provided update only account_type
			DB::table('account')->where('username', Input::get('username'))->update(['password' => Hash::make(Input::get('password1'))]);

			//set Session to show the status in index page
			Session::flash('action', 'UPDATE_SUCCESS');

			return Redirect::route('admin.index');
		} else {
			Session::flash('action', 'UPDATE_FAILED');

			return Redirect::back()->withInput()->withErrors($val);
		}
	}

	public function delete($id)
	{
		if ( ! Account::check_admin_session()) {
			return View::make('admin.login');
		}

		$acc_type = Administrator::get_account_type($id);

		if ($acc_type == 1) {
			return View::make('admin.delete', compact('id'));
		} elseif ($acc_type == 2) {
			return View::make('professor.delete', compact('id'));
		} elseif ($acc_type == 3) {
			return View::make('student.delete', compact('id'));
		} else {
			Redirect::route('admin.index');
		}
	}

	public function destroy($id)
	{
		if ( ! Account::check_admin_session()) {
			return View::make('admin.login');
		}

		Session::flash('action', 'DELETE_SUCCESS');
		Administrator::destroy($id);

		return Redirect::route('admin.index');
	}

	public function login()
	{
		// if (Administrator::login_user()) {
		// 	return Redirect::route('admin.index');
		// } else {
		// 	Session::flash('action', 'LOGIN_FAILED');

		// 	return Redirect::back()->withInput();
		// }

		if (Auth::attempt( ['username'=>Input::get('username'), 'password'=>Input::get('password')] )) {
			
			Administrator::login_user_revised();

	        if(Session::has('redirect_to')) {
	        	$redirect_to = Session::get('redirect_to');
	        	Session::forget('redirect_to'); 
				return Redirect::to($redirect_to);
	        } else {
            	return Redirect::route('admin.index');
	        }
        } else {
            return Redirect::route('indexes')
                ->with('action', 'LOGIN_FAILED')
                ->withInput();
        }
	}

	public function get_login() {
		/* check if remember-me is present */
		if (Cache::has('remember')) {
			/* Verify cookie baka fake :-P */
			if (Administrator::check_cookie()) {
				/* Cookie verified!!! */
				if (Session::has('username') && Session::has('hash_key')) {
					Administrator::generate_hash_key();		/* Generate new session. */

					return Redirect::route('admin.index');
				} else {
					Administrator::generate_new_session();	/* Generate a new session from Cache instead */

					return Redirect::route('admin.index');
				}
			} else {
				return View::make('admin.login');
			}
		} else {
			return View::make('admin.login');
		}
	}

	public function logout()
	{
		Account::logout_user();

		return Redirect::route('indexes');
	}

	public function search()
	{
		$skey  = Input::get('skey');
		$stype = Input::get('user_type');
		//check hash_key to database and account_type
		if (Account::check_admin_session()) {
			$users = DB::table('vw_account_list')->whereRaw("type like '%" . $stype . "%'")->whereRaw("username like '%" . $skey . "%'")->orderby('type')->get();
			return View::make('admin.list', compact('users'));
		} else {
			return View::make('admin.login');
		}
	}

	public function settings()
	{
		$prof_num = Administrator::prof_count();
		$stud_num = Administrator::stud_count();
		$user_num = Administrator::user_count();

		$users = DB::table('vw_account_list')->orderby('type')->get();
		return View::make('admin.settings', compact('users', 'prof_num', 'stud_num', 'user_num'));
	}

	public function searcher()
	{
		if (Request::ajax())
		{
	        if (Account::check_admin_session()) {
	        	/* get input from form */
				$skey  = Input::get('skey');
				$stype = Input::get('user_type');

				$users = DB::table('vw_account_list')->whereRaw("type like '%" . $stype . "%'")->whereRaw("username like '%" . $skey . "%'")->orderby('type')->get();
				$count = DB::table('vw_account_list')->whereRaw("type like '%" . $stype . "%'")->whereRaw("username like '%".$skey."%'")->orderby('type')->count();
				$users = array_add($users, 'count', $count);
				$users = array_add($users, 'skey', $skey);

				return $users;
			} else {
				return View::make('admin.login');
			}
		} else {
			return Redirect::route('admin.index');
		}
	}

	public function home() {
		$ann = Announcement::all();

		return View::make('index', compact('ann'));
	}
}