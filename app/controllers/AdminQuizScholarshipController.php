<?php

class AdminQuizScholarshipController extends \BaseController {
	public static $active = 'open';
	/**
	 * Display a listing of the resource.
	 *
	 * @param  int  $quiz_id
	 * @return Response
	 */
	public function index($quiz_id)
	{
		if (!Account::check_admin_session()) {
			return View::make('admin.login');
		} 

		$ux = new StdClass();

		$ux->quiz 		 		= self::$active;
		$ux->quiz_scholarship 	= self::$active;
		$ux->breadcrumbs 		= App::make('AdminQuizScholarshipController')->breadcrumbs().
							  		   '<li class="active"><i class="fa fa-list"></i> SET SCHOLARSHIP LIST</li>';

		$scholarships = ScholarshipQuiz::with(array('scholarship', 
													'scholarship.scholarship_discount'))
								 	   ->where('quiz_id', '=', $quiz_id)
								 	   ->get();

		return View::make('administrator.quiz-scholarship.index')
				   ->with('quiz_id', $quiz_id)
				   ->with('scholarships', $scholarships)
				   ->with('ux', $ux);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @param  int  $quiz_id
	 * @return Response
	 */
	public function create($quiz_id)
	{
		if (!Account::check_admin_session()) {
			return View::make('admin.login');
		} 

		$ux = new StdClass();

		$ux->quiz 		 		= self::$active;
		$ux->quiz_scholarship 	= self::$active;
		$ux->breadcrumbs 		= App::make('AdminQuizScholarshipController')->breadcrumbs().
									   '<li class="active"><a href="'.URL::to('administrator/quiz/'.$quiz_id.'/scholarship').'"><i class="fa fa-list"></i> SET SCHOLARSHIP LIST</li></a>
									   <li class="active"><i class="fa fa-plus"></i> ADD SCHOLARSHIP</li>';

		$scholarships = ScholarshipDiscount::with(array('scholarship'))
								 	   	   ->get();

		foreach ($scholarships as $scholarship) {
			$value = ($scholarship->type == 'fix') ? 'P'.$scholarship->value : $scholarship->value.'%';

			$scholarship_name[$scholarship->id] = Str::upper("NAME: ".$scholarship->scholarship->name." | ".
															 "TYPE: ".$scholarship->type." | ".
															 "VALUE: ".$value." | ".
															 "SY: ".$scholarship->school_year);
		}

		return View::make('administrator.quiz-scholarship.create')
				   ->with('quiz_id', $quiz_id)
				   ->with('scholarships', $scholarships)
				   ->with('scholarship_name', $scholarship_name)
				   ->with('ux', $ux);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  int  $quiz_id
	 * @return Response
	 */
	public function store($quiz_id)
	{
		if (!Account::check_admin_session()) {
			return View::make('admin.login');
		} 

		$scholarship = ScholarshipDiscount::with('scholarship')
										  ->find(Input::get('id'));

		// S: CHECK IF SCHOLARSHIP ALREADY ASSIGNED ON QUIZ AND
		//    ALL QUESTION HAS ATLEAST 1 CORRECT ANSWER	
		$validator = ScholarshipQuiz::validate($scholarship, $quiz_id);
		// E: CHECK IF SCHOLARSHIP ALREADY ASSIGNED ON QUIZ
		//    ALL QUESTION HAS ATLEAST 1 CORRECT ANSWER	

	    if ($validator == true) {
	        $scholarship = new ScholarshipQuiz(array(
	        	'scholarship_id'	=> $scholarship->scholarship_id,
	         	'quiz_id'			=> $quiz_id,
	         	'school_year'		=> $scholarship->school_year
	        ));
	        $scholarship->save();
	        
	        Session::flash('message', $scholarship->scholarship->name.' scholarship set successfully.');
	        Session::flash('class', 'alert-success');

	        return Redirect::to('administrator/quiz/'.$quiz_id.'/scholarship');
	    } else {
	        return Redirect::to('administrator/quiz/'.$quiz_id.'/scholarship/create')
	        				 ->withInput();
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
		// NO MORE DATA TO SHOW
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($quiz_id, $scholarship_id)
	{
		if (!Account::check_admin_session()) {
			return View::make('admin.login');
		} 
		
		$scholarship = ScholarshipQuiz::find($scholarship_id);

		$scholarship->delete();

		Session::flash('message', 'Selected scholarship successfully deleted.');
		Session::flash('class', 'alert-success');

		return Redirect::to('administrator/quiz/'.$quiz_id.'/scholarship');
	}

	public function examStationMode()
	{
		if (!Account::check_admin_session()) {
			return View::make('admin.login');
		} 

		Session::flush();
		Session::put('exam_station_mode', true);

		return Redirect::to('scholarship');
	}

	public function breadcrumbs()
	{
		return '<li><a href="'.URL::to('administrator').'"><i class="fa fa-dashboard"></i> DASHBOARD</a></li>
				<li><i class="fa fa-certificate"></i> SCHOLARSHIP</li>
                <li><i class="fa fa-pencil"></i> EXAMINATION</li>
                <li><a href="'.URL::to('administrator/quiz').'"><i class="fa fa-list"></i> EXAMINATION LIST</a></li>
				<li><i class="fa fa-certificate"></i> SET SCHOLARSHIP</li>';
	}
}