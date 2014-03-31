<?php

class StudentController extends BaseController {

	public function create()
	{
		//auto generate key.
		//check first if there is data inside.
		$key = '';

		$ctr = DB::table('student')->count();
		if ($ctr > 0) {
			//get last data.
			$ctr = DB::table('student')->select('student_number')->orderby('student_number', 'DESC')->first();
			//echo $ctr->student_number;

			//check if the date is current date.
			$val = starts_with($ctr->student_number, date('Y'));
			if ($val) {
				//if current date, then add 1
				$key = $ctr->student_number + 1;
			} else {
				//if not then create a new generate
				$key = date('Y') . '00000';
			}
		} else {
			$key = date('Y') . '00000';
		}

		//get year level
		$yr = Student::get_yr_list();

		//date from 1 - 31
		$bdate = array();
		for ($i = 1; $i < 32; $i++) {
			$bdate = array_add($bdate, $i, $i);
		}

		//month from Jan to Dec
		$bmonth = array( '1' => 'January', '2' => 'Feruary', '3' => 'March', '4' => 'April', '5' => 'May', '6' => 'June', '7' => 'July', '8' => 'August', '9' => 'September', '10' => 'October', '11' => 'November', '12' => 'December');

		//year from 1980 - 2020
		$byear = array();
		for ($i = 1980; $i < 2020; $i++) {
			$byear = array_add($byear, $i, $i);
		}

        return View::make('student.create', compact('key', 'yr', 'bdate', 'bmonth', 'byear'));
	}

	public function store()
	{
		$validation = Validator::make(Input::all(), [
			'studno'       =>'required|unique:student,student_number|numeric',
			'fname'        =>'required',
			'mi'           =>'required',
			'lname'        =>'required',
			'gender'       =>'required',
			'bdate'        =>'numeric',
			'bmonth'       =>'numeric',
			'byear'        =>'numeric',
			'yr'           =>'required',
			'account_type' =>'required',
			'password1'    =>'required|same:password2|min:6',
			'password2'    =>'required',
			'contact'      =>'required|size:11',
			'email'        =>'email']
		);

		if ($validation->passes()) {

			if ($_FILES["picture"]["error"] > 0){
				echo "Error Code: " . $_FILES["picture"]["error"] . "<br />";
			}

			if (file_exists("upload/" . $_FILES["picture"]["name"]))
			{
				echo $_FILES["picture"]["name"] . " already exists. ";
			} else {
				move_uploaded_file($_FILES["picture"]["tmp_name"], "public/uploads/" . Input::get('studno') . ".jpg");
		      	// echo "Stored in: " . "uploads/" . $_FILES["picture"]["name"];
			}

			$stud_id = Input::get('studno');

			/* Add student to the database */
			$account                  = new Administrator;
			$account->username        = $stud_id;
			$account->account_type_id = 3;
			$account->password        = Hash::make(Input::get('password1'));
			$account->save();

			/* get ID from Account table. */
			$x = DB::table('account')->select('id')->where('account_type_id', 3)->orderBy('id', 'desc')->first();

			$student                 = new Student;
			$student->id             = $x->id;
			$student->student_number = Input::get('studno');
			$student->first_name     = ucwords(Input::get('fname'));
			$student->middle_name    = ucwords(Input::get('mi'));
			$student->last_name      = ucwords(Input::get('lname'));
			$student->gender         = Input::get('gender');
			$student->year_level_id  = Input::get('yr');
			$student->birthdate      = Input::get('byear')."-".Input::get('bmonth')."-".Input::get('bdate');
			$student->contact        = Input::get('contact');
			$student->email          = Input::get('email');
			$student->save();

			/* Update students grade for the encoding */
			Student::add_student_subject($x->id);

			return Redirect::route('stud.create')->with('action', 'CREATE_STUDENT_SUCCESS');
		} else {
			return Redirect::back()->withInput()->withErrors($validation);
		}
	}

	public function edit($id)
	{
		$user = DB::table('vw_student_list')->where('id', $id)->first();

		$user->byear  = substr($user->birthdate, 0, 4);
		$user->bmonth = substr($user->birthdate, 5, 2);
		$user->bdate  = substr($user->birthdate, 8, 2);

		//get year level
		$yr = Student::get_yr_list();

		//date from 1 - 31
		$bdate = array();
		for ($i = 1; $i < 32; $i++) {
			$bdate = array_add($bdate, $i, $i);
		}

		//month from Jan to Dec
		$bmonth = array( '1' => 'January', '2' => 'Feruary', '3' => 'March', '4' => 'April', '5' => 'May', '6' => 'June', '7' => 'July', '8' => 'August', '9' => 'September', '10' => 'October', '11' => 'November', '12' => 'December');

		//year from 1980 - 2020
		$byear = array();
		for ($i = 1980; $i < 2020; $i++) {
			$byear = array_add($byear, $i, $i);
		}

        return View::make('student.edit', compact('user', 'yr' ,'bdate', 'bmonth', 'byear'));
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
				'mi'           => 'required',
				'lname'        => 'required',
				'gender'       => 'required',
				'bdate'        => 'numeric',
				'bmonth'       => 'numeric',
				'byear'        => 'numeric',
				'yr'           => 'required',
				'account_type' => 'required',
				'password1'    => 'same:password2|min:6',
				'password2'    => 'reuired',
				'contact'      => 'required|size:11',
				'email'        => 'email'
			]
		);

		if ($validation->passes()) {

			move_uploaded_file($_FILES["picture"]["tmp_name"], "public/uploads/" . Input::get('studno') . ".jpg");

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
			} else {
				/*process with password */
				DB::table('account')->where('id', $id)->update(['password' => Hash::make(Input::get('password1')) ]);

				DB::table('student')
					->where('id', $id)
					->where('student_number', Input::get('studno'))
					->update([
						'first_name'    => ucwords(Input::get('fname')),
						'middle_name'   => ucwords(Input::get('mi')),
						'last_name'     => ucwords(Input::get('lname')),
						'gender'        => Input::get('gender'),
						'year_level_id' => Input::get('yr'),
						'contact'       => Input::get('contact'),
						'email'         => Input::get('email'),
				]);
			}
			Session::flash('action', 'UPDATE_SUCCESS');

			return Redirect::route('admin.index');
		} else {
			return Redirect::back()->withInput()->withErrors($validation);
		}
	}

	public function show($id)
	{
    	$user = DB::table('vw_student_list')->where('id', $id)->first();

		return View::make('student.show', compact('user'));
	}

	public function lists()
	{
		$users = DB::table('vw_account_list')->where('type', 'Student')->orderby('type')->get();

		return View::make('student.list', compact('users', 'count'));	
	}
	

	public function delete($id)
	{
		//check if student exists
        if (Subject::subj_exist($id)) {
            return View::make('student.delete', compact('id'));
        } else {
            return Redirect::route('stud.index');
        }
	}

	public function destroy($id)
	{
		Session::flash('action', 'DELETE_SUCCESS');
		Administrator::destroy($id);

		return Redirect::route('admin.index');
	}
}
