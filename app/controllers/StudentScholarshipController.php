<?php

class StudentScholarshipController extends \BaseController {

	public $rules = array(
        'scholarship_id' => 'required|integer|exists:scholarship_discount,scholarship_id|unique:student_scholarship,student_id,NULL,id,school_year,',
    );
	// public $rules = array(
 //        'scholarship_id' => 'required|integer|exists:scholarship_discount,scholarship_id|unique:student_scholarship,school_year,NULL,id,school_year,',
 //    );

	/**
	 * Display a listing of the resource.
	 *
	 * @param  int  $student
	 * @return Response
	 */
	public function index($student)
	{
	    //check hash_key to database and account_type
		if (Account::check_admin_session()) {

		//get data
		$student = Student::find($student);

		$student->load('scholarship.scholarship.discount');

		//load scholarship details
			// echo $scholarship->school_year;
			// $student->scholarship->load(
			// 	array(
			// 		'scholarship.discount' =>
			// 		function($query) use($student)
			// 		{
			// 			foreach ($student->scholarship as $scholarship) {
			// 				$query->where('school_year', $scholarship->school_year);
			// 			}
			// 		}
			// 	)
			// );

		// Uncomment to show queries
		/***
			$queries = DB::getQueryLog();
			$last_query = end($queries);
			return $queries;
		*/

		// return $student;
		// return $scholarships;
		return View::make(
			'student.scholarship.index',
			array(
				'student' => $student
			)
		);
		} else {
			return View::make('admin.login');
		}
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($student)
	{
	    //check hash_key to database and account_type
		if (Account::check_admin_session()) {

		//get data
		$student = Student::find($student);
		$config_school_year = Configuration::first()->school_year;
		$scholarships = ScholarshipDiscount::where('school_year',$config_school_year)->get();
		$scholarships->load('scholarship');

		//scholarship select
		$scholarship_options = array();
		foreach ($scholarships as $scholarship) {
			$scholarship_options[$scholarship->scholarship_id] = $scholarship->scholarship->name;
		}

		// return $scholarship_options;
		// return $scholarships;
		// return $config_school_year;	

		return View::make(
			'student.scholarship.create',
			array(
				'student' => $student,
				'scholarships' => $scholarships,
				'scholarship_options' => $scholarship_options
			));


		} else {
			return View::make('admin.login');
		}
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($student)
	{
	    //check hash_key to database and account_type
		if (Account::check_admin_session()) {

			//get data
			$config_school_year = Configuration::first()->school_year;
			$student = Student::find($student);

			//set school_year rule
			$this->rules['scholarship_id'] .= $config_school_year;

			$validator = Validator::make(
				Input::all(),
				$this->rules
			);

			// return $this->rules;
			// return Input::all();
			// return $validator->messages();

			if ($validator->fails())
			{
				// The given data did not pass validation
				//set message
				$msg_class 	= 'alert alert-dismissable alert-danger';
				$msg 		= '<strong>Submission fails!</strong> '.$validator->messages()->first();

				//flash Inputs
				Input::flash();
			}else{

				$student_scholarship = new StudentScholarship(Input::all());
				$student_scholarship->school_year = $config_school_year;

				// return $student_scholarship;
				if($student->scholarship()->save($student_scholarship)){
					//set message
					$msg_class 	= 'alert alert-dismissable alert-success';
					$msg 		= '<strong>Well done!</strong> Student Violation has been added successfully.';
				}else{
					//set message
					$msg_class 	= 'alert alert-dismissable alert-warning';
					$msg 		= '<strong>System Error!</strong> <em>Valid</em> Student Violation could not be saved.';
				}
				
			}

			//message
			Session::flash('class', $msg_class);
			Session::flash('message', $msg);

			//redirect
			return Redirect::route(
				$validator->fails() ? 'administrator.student.scholarship.create':'administrator.student.scholarship.index',
				$student->id)->withStudent($student);

		} else {
			return View::make('admin.login');
		}

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
	    //check hash_key to database and account_type
		if (Account::check_admin_session()) {

		//
		} else {
			return View::make('admin.login');
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
	    //check hash_key to database and account_type
		if (Account::check_admin_session()) {

		//
		} else {
			return View::make('admin.login');
		}
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
	    //check hash_key to database and account_type
		if (Account::check_admin_session()) {

		//
		} else {
			return View::make('admin.login');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($student)
	{
	    //check hash_key to database and account_type
		if (Account::check_admin_session()) {

			//get data
			// return Input::all();
			$scholarship = Input::get('scholarship');
			$school_year = Input::get('school_year');

			$student = Student::find($student);
			$scholarship = StudentScholarship::
					where("student_id", $student->id)->
					where("scholarship_id", $scholarship)->
					where("school_year", $school_year);
			$scholarship_data = $scholarship->get()->first();
			$scholarship_data->load('scholarship');
			

			// return $scholarship->get();
			//delete
			if ($scholarship->delete()) {
				//set message
				$msg_class 	= 'alert alert-dismissable alert-success';
				$msg 		= '<strong>Well done!</strong> Student Scholarship: \''.
					$scholarship_data->scholarship->name.
					'\' for School Year '.
					$scholarship_data->school_year.
					' has been deleted';
			}else {
				//set message
				$msg_class 	= 'alert alert-dismissable alert-danger';
				$msg 		= '<strong>Scholarship not deleted!</strong> 
					Try submitting <strong>\''.$scholarship_data->scholarship->name.'\'@'.$scholarship_data->school_year.'</strong> again.';
			}

			//message
			Session::flash('class', $msg_class);
			Session::flash('message', $msg);

		//log

		//redirect
		return Redirect::route('administrator.student.scholarship.index',$student->id);
		} else {
			return View::make('admin.login');
		}
	}

}