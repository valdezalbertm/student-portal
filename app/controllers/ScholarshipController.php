<?php

class ScholarshipController extends \BaseController {
	public static $active = 'open';
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
	    //check hash_key to database and account_type
		if (Account::check_admin_session()) {
			$scholarships = Scholarship::where('id','!=',0)->paginate(15);
			return View::make('scholarship.index')->withScholarships($scholarships);
		} else {
			return View::make('admin.login');
		}

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
	    //check hash_key to database and account_type
		if (Account::check_admin_session()) {
			
		return View::make('scholarship.create');
		} else {
			return View::make('admin.login');
		}
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
	    //check hash_key to database and account_type
		if (Account::check_admin_session()) {
			
		$validator = Validator::make(
			Input::all(),
			Scholarship::$rules
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

			$scholarship = new Scholarship(Input::all());
			if($scholarship->save()){
				//set message
				$msg_class 	= 'alert alert-dismissable alert-success';
				$msg 		= '<strong>Well done!</strong> Scholarship has been added successfully.';
			}else{
				//set message
				$msg_class 	= 'alert alert-dismissable alert-warning';
				$msg 		= '<strong>System Error!</strong> <em>Valid</em> Scholarship could not be saved.';
			}
			
		}

		//message
		Session::flash('class', $msg_class);
		Session::flash('message', $msg);

		//redirect
		return Redirect::route(
			$validator->fails() ? 'administrator.scholarship.create':'administrator.scholarship.index',
			$scholarship->id)->withScholarship($scholarship);
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
		//prepare schoolyear for select
		$schoolyear = SchoolYear::get(array('name'));
		$schoolyear = array_fetch($schoolyear->toArray(),'name');
		$schoolyear_temp = array();
		foreach ($schoolyear as $value) {
			$schoolyear_temp[$value] = $value;
		}
			// return $schoolyear;
		$schoolyear = $schoolyear_temp;

		//get other data
		$scholarship = Scholarship::find($id);
		$discounts	 = $scholarship->discount()->paginate(15);

		return View::make('scholarship.show')
			->withScholarship($scholarship)
			->withDiscounts($discounts)
			->withSchoolYear($schoolyear);
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
			
		$scholarship = Scholarship::find($id);
		return View::make('scholarship.edit')->withScholarship($scholarship);
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
			
		$scholarship = Scholarship::find($id);
		$validator = Validator::make(
			Input::all(),
			Scholarship::$rules
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
			$scholarship->name = Input::get('name');

			if($scholarship->save()){
				//set message
				$msg_class 	= 'alert alert-dismissable alert-success';
				$msg 		= '<strong>Well done!</strong> Scholarship has been added successfully.';
			}else{
				//set message
				$msg_class 	= 'alert alert-dismissable alert-warning';
				$msg 		= '<strong>System Error!</strong> <em>Valid</em> Scholarship could not be saved.';
			}
			
		}

		//message
		Session::flash('class', $msg_class);
		Session::flash('message', $msg);

		//redirect
		return 
			Redirect::route(
				$validator->fails() ? 'administrator.scholarship.edit':'administrator.scholarship.show', 
				array($scholarship->id)
			)->withScholarship($scholarship);
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
	public function destroy($id)
	{
	    //check hash_key to database and account_type
		if (Account::check_admin_session()) {
			
		//get data
		$scholarship = Scholarship::find($id);
		
		//delete
		if ($scholarship->delete()) {
			//set message
			$msg_class 	= 'alert alert-dismissable alert-success';
			$msg 		= '<strong>Well done!</strong> Scholarship : \''.$scholarship->name.'\' has been deleted';
		}else {
			//set message
			$msg_class 	= 'alert alert-dismissable alert-danger';
			$msg 		= '<strong>Scholarship not deleted!</strong> 
				Try submitting <strong>\''.$scholarship->name.'\'</strong> again.';
		}

		//message
		Session::flash('class', $msg_class);
		Session::flash('message', $msg);

		//log

		//redirect
		return Redirect::route('administrator.scholarship.index');
		} else {
			return View::make('admin.login');
		}
	}

	public function report()
	{
		if (!Account::check_admin_session()) {
			return View::make('admin.login');
		} 

		$ux = new StdClass();

		$ux->scholarship = self::$active;
		$ux->breadcrumbs = App::make('ScholarshipController')->breadcrumbs().
							    '<li class="active"><i class="fa fa-copy"></i> REPORTS</li>';

		$students = StudentScholarshipQuizResult::with(array('student', 
													         'scholarship'))
											    ->get();
				
		$applicants = ApplicantScholarshipQuizResult::with(array('applicant', 
													        	 'scholarship'))
											        ->get();		

		return View::make('administrator.scholarship.reports')
				   ->with('students', $students)
				   ->with('applicants', $applicants)
				   ->with('ux', $ux);
	}

	public function destroyReport($user, $id)
	{					
		if (!Account::check_admin_session()) {
			return View::make('admin.login');
		} 
		
		$user_model = ($user == 'student' ? 
						'StudentScholarshipQuizResult' : 
						'ApplicantScholarshipQuizResult'
					 );			

		$report = $user_model::find($id);
		// $title 	= $quiz->title;
		
		$report->delete();

		Session::flash('message', Str::title($user).' record successfully deleted.');
		Session::flash('class', 'alert-success');
		return Redirect::to('administrator/scholarship/reports');
		 //return Redirect::to('scholarship/quiz/applicant/'.$scholarhip_quiz->id);   
	}

	public function printReport($user_type, $print_type)
	{
		if (!Account::check_admin_session()) {
			return View::make('admin.login');
		} 

		$user_model = ($user_type == 'student' ? 
						'StudentScholarshipQuizResult' : 
						'ApplicantScholarshipQuizResult'
					 );	
		if ($print_type == 'all') {
			$scholarship_quiz_result = $user_model::with(array($user_type, 
												 			   'scholarship'))
								    			  ->get();
		} else {
			$scholarship_quiz_result = $user_model::where('is_pass', '=', 1)
												  ->with(array($user_type, 
												 			   'scholarship'))
								    			  ->get();
		}

		return View::make('administrator.scholarship.print')
				   ->with('scholarship_quiz_result', $scholarship_quiz_result)
				   ->with('user_type', $user_type)
				   ->with('print_type', $print_type);
	}
	public function breadcrumbs()
	{
		return '<li><a href="'.URL::to('administrator').'"><i class="fa fa-dashboard"></i> DASHBOARD</a></li>
                <li><i class="fa fa-certificate"></i> SCHOLARSHIP</li>';
	}
}