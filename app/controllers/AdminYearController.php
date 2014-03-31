<?php

class AdminYearController extends \BaseController {

	public function index()
	{
		$users = DB::table('vw_student_list')->get();

		return View::make('yearlevel.student.index', compact('users'));
	}

	public function edit($id){
		$user = DB::table('vw_student_list')->where('id', $id)->first();

		//get year level
		$yr = Student::get_yr_list();

        return View::make('yearlevel.student.update', compact('user', 'yr'));
	}

	public function update($id)
	{
        $validation = Validator::make(
			Input::all(),
			[
				'studno'       => 'required',
				'studno'       => 'unique:student,student_number',
				'studno'       => 'numeric',
				'fname'        => 'required',
				'yr'           => 'required',
			]
		);

		if ($validation->passes()) {
			if (Input::get('password1') == '') {
				/* process without password */
				DB::table('student')
					->where('id', $id)
					->where('student_number', Input::get('studno'))->update([
						'first_name'    => ucwords(Input::get('fname')),
						'middle_name'   => ucwords(Input::get('mi')),
						'last_name'     => ucwords(Input::get('lname')),
						'gender'        => Input::get('gender'),
						'year_level_id' => Input::get('yr'),
						'contact'       => Input::get('contact'),
						'email'         => Input::get('email')
				]);
			}
			Session::flash('action', 'YEAR_LEVEL_UPDATED');

			return Redirect::back();
			//->withInput()->with('action', 'YEAR_LEVEL_UPDATED')
		} else {
			return Redirect::back()->withInput()->withErrors($validation);
		}
	}
}