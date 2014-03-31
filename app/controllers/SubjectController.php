<?php

class SubjectController extends BaseController {
	public function index()
	{
		if ( ! Account::check_admin_prof_session()) {
			Administrator::logout_user();

			return View::make('admin.login');
		}

		$subjs = Subject::all();

		return View::make('subject.index', compact('subjs'));
	}

	public function show($id)
	{
		$subj = Subject::find($id);
		return View::make('subject.show', compact('subj'));
	}

	public function create()
	{
		return View::make('subject.create');
	}

	public function store()
	{
		$val = Validator::make(
			Input::all(), [
				'sname' => 'required|unique:subject,name',
				'scode' => 'required|unique:subject,code'
			] );

		if ($val->passes()) {
			/* Add for first year subject */
			$subj = new Subject;
			$subj->name = Input::get('sname') . " 1";
			$subj->code = Input::get('scode') . 1;
			$subj->save();

			/* Add for second year subject */
			$subj = new Subject;
			$subj->name = Input::get('sname') . " 2";
			$subj->code = Input::get('scode') . 2;
			$subj->save();

			/* Add for third year subject */
			$subj = new Subject;
			$subj->name = Input::get('sname') . " 3";
			$subj->code = Input::get('scode') . 3;
			$subj->save();

			/* Add for fourth year subject */
			$subj = new Subject;
			$subj->name = Input::get('sname') . " 4";
			$subj->code = Input::get('scode') . 4;
			$subj->save();

			/* Get subject ID of first inserted. */
			$sid = DB::table('subject')->orderBy('id', 'desc')->first();

			/* Update each students subjects */
			/* Select all students */
			$studs = Student::all();

			foreach ($studs as $stud) {
				/* Save each student with newly added subject */

				/* For first year */
				DB::table('student_grade')->insert(
				    array(
				    	'student_id' => $stud->id,
				    	'year_level_id' => 1,
				    	'subject_id' => $sid->id - 3,
				    	'school_year' => 1,
				    	'score' => 0,
				    	)
				);
				/* For second year */
				DB::table('student_grade')->insert(
				    array(
				    	'student_id' => $stud->id,
				    	'year_level_id' => 2,
				    	'subject_id' => $sid->id - 2,
				    	'school_year' => 2,
				    	'score' => 0,
				    	)
				);
				/* For third year */
				DB::table('student_grade')->insert(
				    array(
				    	'student_id' => $stud->id,
				    	'year_level_id' => 3,
				    	'subject_id' => $sid->id - 1,
				    	'school_year' => 3,
				    	'score' => 0,
				    	)
				);
				/* For fourth year */
				DB::table('student_grade')->insert(
				    array(
				    	'student_id' => $stud->id,
				    	'year_level_id' => 4,
				    	'subject_id' => $sid->id,
				    	'school_year' => 4,
				    	'score' => 0,
				    	)
				);
			}

			return Redirect::route('subj.index')->with('action', 'SUBJECT_CREATE_SUCCESS');
		} else {
			return Redirect::back()->withInput()->withErrors($val);
		}
	}

	public function edit($id)
	{
		$subj = Subject::find($id);
		return View::make('subject.edit', compact('subj'));
	}

	public function update($id)
	{
		$val = Validator::make(Input::all(), ['sname' => 'required']);

		if ($val->passes()) {
			$subj = Subject::find($id);
			$subj->code = Input::get('scode');
			$subj->name = Input::get('sname');
			$subj->save();

			Session::flash('action', 'SUBJECT_UPDATE_SUCCESS');

			return Redirect::route('subj.index');
		} else {
			return Redirect::back()->withInput()->withErrors($val);
		}
	}

	public function delete($id)
	{
		//check if subject exists
		if (Subject::subj_exist($id)) {
			return View::make('subject.delete', compact('id'));
		} else {
			return Redirect::route('subj.index');
		}
	}

	public function destroy($id)
	{
		// if ( ! Administrator::check_admin_session()) {
		// 	return View::make('admin.login');
		// }

		Session::flash('action', 'DELETE_SUCCESS');
		Administrator::destroy($id);

		return Redirect::route('admin.list');
	}

	public function search()
	{
		if ( ! Account::check_admin_prof_session()) {
			Session::flush();
			return View::make('admin.login');
		}

		$skey = Input::get('skey');
		$subjs = DB::table('subject')->whereRaw("name like '%" . $skey . "%'")->get();
		return View::make('subject.index', compact('subjs', 'skey'));
	}
}