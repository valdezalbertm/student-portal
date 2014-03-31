<?php

class ProfessorController extends BaseController {

	public function index()
	{
        return View::make('professor.index');
	}

	public function create()
	{
		//get department IDs
		$dept = Professor::get_dept_list();

        return View::make('professor.create', compact('dept'));
	}

	public function store()
	{
		$val = Validator::make(Input::all(), [
			'username'     => 'required|unique:account,username',
			'account_type' => 'required',
			'password1'    => 'required|same:password2',
			'password2'    => 'required',
			'lname'        => 'required',
			'mi'           => 'required',
			'fname'        => 'required',
			'contact'      => 'required|size:11',
			'email'        => 'required|email',
			'dept'         => 'required|numeric'
		] );

		if ($val->passes()) {
			$account                  = new Administrator;
			$account->username        = Input::get('username');
			$account->account_type_id = 2;
			//$account->password      = hash('sha512', Input::get('password1'));
			$account->password        = Hash::make(Input::get('password1'));
			$account->save();

			//get ID from Account table.
			$x = DB::table('account')->select('id')->orderBy('id', 'desc')->first();

			$prof                = new Professor;
			$prof->user_id       = $x->id;
			$prof->last_name     = ucfirst(Input::get('lname'));
			$prof->middle_name   = ucfirst(Input::get('mi'));
			$prof->first_name    = ucfirst(Input::get('fname'));
			$prof->contact       = Input::get('contact');
			$prof->email         = Input::get('email');
			$prof->department_id = Input::get('dept');

			$prof->save();

			Session::flash('action', 'CREATE_SUCCESS');

			return Redirect::route('admin.index');
		} else {
			return Redirect::back()->withInput()->withErrors($val);
		}
	}

	public function show($id)
	{
		$user = DB::table('vw_professor_list')->where('id', $id)->first();
        return View::make('professor.show', compact('user'));
	}

	public function edit($id)
	{
		$dept = Professor::get_dept_list();
		$user = DB::table('vw_professor_list')->where('id', $id)->first();

		return View::make('professor.edit', ['user' => $user, 'dept' => $dept] );
	}

	public function update($id)
	{
		// if ( ! Administrator::check_admin_session()) {
		// 	return View::make('admin.login');
		// }

		$val = Validator::make(
			Input::all(), [
				'fname'     => 'required',
				'mi'        => 'required',
				'lname'     => 'required',
				'password1' => 'same:password2|min:6',
				'contact'   => 'required|size:11',
				'email'     => 'required',
				'email'     => 'email',
				'dept'      => 'required',
				'dept'      => 'numeric',
			]
		);

		if ($val->passes()) {
			//if no pass provided update only account_type
			if (Input::get('password1') == '') {
				DB::table('instructor')->where('user_id', $id)->update([
					'first_name'    => ucwords(Input::get('fname')),
					'middle_name'   => ucwords(Input::get('mi')),
					'last_name'     => ucwords(Input::get('lname')),
					'contact'       => Input::get('contact'),
					'email'         => Input::get('email'),
					'department_id' => Input::get('dept')
				]);
			} else {
				DB::table('instructor')->where('user_id', $id)->update([
					'first_name'    =>  ucwords(Input::get('fname')),
					'middle_name'   =>  ucwords(Input::get('mi')),
					'last_name'     =>  ucwords(Input::get('lname')),
					'contact'       => Input::get('contact'),
					'email'         => Input::get('email'),
					'department_id' => Input::get('dept')
				]);
				DB::table('account')->where('id', $id)->update(['password' => Hash::make(Input::get('password1')) ]);
			}

			//set Session to show the status in index page
			Session::flash('action', 'UPDATE_SUCCESS');

			return Redirect::route('admin.list');
		} else {
			Session::flash('action', 'UPDATE_FAILED');

			return Redirect::back()->withInput()->withErrors($val);
		}
		return 'You are about to update!';
	}

	public function delete($id)
	{
		//check if professor exists
		if (Professor::prof_exist($id)) {
			return View::make('professor.delete', compact('id'));
		} else {
			return Redirect::route('admin.index');
		}
	}

	public function destroy($id)
	{
		if ( ! Administrator::check_admin_session()) {
			return View::make('admin.login');
		}

		Session::flash('action', 'DELETE_SUCCESS');
		Administrator::destroy($id);

		return Redirect::route('admin.list');
	}

}
