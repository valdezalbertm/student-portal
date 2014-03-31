<?php

class StudentPenaltyController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * @param  int  $student
	 * @return Response
	 */
	public function index($student)
	{
	    //check hash_key to database and account_type
		if (Account::check_admin_session()) {
			
		// echo "string";
		$student = Student::find($student);
		// $records = $student->penalty;
		$records = StudentPenalty::where('student_id',$student->id)->orderby('date')->paginate(5);
		// echo $records;
		// foreach ($records as $record) {
		//  	echo($record);
		//  	echo $records->links();
		//  } $records;
		// die();
		return View::make(
			'student.penalty.index',
			array(
				'student' => $student, 
				'records' => $records
			)
		);
		} else {
			return View::make('admin.login');
		}


	}

	/**
	 * Show the form for creating a new resource.
	 * @param  int  $student
	 * @return Response
	 */
	public function create($student)
	{
	    //check hash_key to database and account_type
		if (Account::check_admin_session()) {

		//
		$student = Student::find($student);
		return View::make('student.penalty.create')->withStudent($student);
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
			// echo "<pre>";
			// dd(Input::all());
			// echo "</pre>";
		$student = Student::find($student);
		$validator = Validator::make(
			Input::all(),
			StudentPenalty::$rules
		);

		if ($validator->fails())
		{
			// The given data did not pass validation
			//set message
			$msg_class 	= 'alert alert-dismissable alert-danger';
			$msg 		= '<strong>Submission fails!</strong> '.$validator->messages()->first();

			//flash Inputs
			Input::flash();
		}else{

			$penalty = new StudentPenalty(Input::all());
			if($student->penalty()->save($penalty)){
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
			$validator->fails() ? 'administrator.student.penalty.create':'administrator.student.penalty.index',
			$student->id)->withStudent($student);
		} else {
			return View::make('admin.login');
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int $student
	 * @param  int $penalty
	 * @return Response
	 */
	public function show($student,$penalty)
	{
	    //check hash_key to database and account_type
		if (Account::check_admin_session()) {

		//
		$student = Student::find($student);
		$penalty = $student->penalty()->find($penalty);
		return View::make('student.penalty.show')->withStudent($student)->withPenalty($penalty);
		} else {
			return View::make('admin.login');
		}

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $student
	 * @param  int $penalty
	 * @return Response
	 */
	public function edit($student,$penalty)
	{
	    //check hash_key to database and account_type
		if (Account::check_admin_session()) {

		//
		// echo $student,' ',$penalty;
		$student = Student::find($student);
		$penalty = $student->penalty()->find($penalty);
		return View::make('student.penalty.edit')->withStudent($student)->withPenalty($penalty);
		} else {
			return View::make('admin.login');
		}
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int $student
	 * @param  int $penalty
	 * @return Response
	 */
	public function update($student,$penalty)
	{
	    //check hash_key to database and account_type
		if (Account::check_admin_session()) {

		//get data
			// echo "<pre>";
			// dd(Input::all());
			// echo "</pre>";
		$student = Student::find($student);
		$penalty = $student->penalty()->find($penalty);
		$validator = Validator::make(
			Input::all(),
			StudentPenalty::$rules
		);

		if ($validator->fails())
		{
			// The given data did not pass validation
			//set message
			$msg_class 	= 'alert alert-dismissable alert-danger';
			$msg 		= '<strong>Submission fails!</strong> '.$validator->messages()->first();

			//flash Inputs
			Input::flash();
		}else{
			//update fields
			$penalty->type = Input::get('type');
			$penalty->date = Input::get('date');
			$penalty->description = Input::get('description');

			if($penalty->save()){
				//set message
				$msg_class 	= 'alert alert-dismissable alert-success';
				$msg 		= '<strong>Well done!</strong> Student Violation has been edited successfully.';
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
		return 
			Redirect::route(
				$validator->fails() ? 'administrator.student.penalty.edit':'administrator.student.penalty.show', 
				array($student->id, $penalty->id)
			)->withStudent($student)->withPenalty($penalty);
		} else {
			return View::make('admin.login');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $student
	 * @param  int  $penalty
	 * @return Response
	 */
	public function destroy($student, $penalty)
	{
	    //check hash_key to database and account_type
		if (Account::check_admin_session()) {

		//get data
		$student = Student::find($student);
		$penalty = $student->penalty()->find($penalty);
		
		//delete
		if ($penalty->delete()) {
			//set message
			$msg_class 	= 'alert alert-dismissable alert-success';
			$msg 		= '<strong>Well done!</strong> Student Violation: \''.$penalty->description.'\' has been deleted';
		}else {
			//set message
			$msg_class 	= 'alert alert-dismissable alert-danger';
			$msg 		= '<strong>Violation not deleted!</strong> 
				Try submitting <strong>\''.$penalty->description.'\'@'.$penalty->date.'</strong> again.';
		}

		//message
		Session::flash('class', $msg_class);
		Session::flash('message', $msg);

		//log

		//redirect
		return Redirect::route('administrator.student.penalty.index',$student->id);
		} else {
			return View::make('admin.login');
		}
	}

}