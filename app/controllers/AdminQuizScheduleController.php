<?php

class AdminQuizScheduleController extends \BaseController {
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

		$ux->quiz 		 	= self::$active;
		$ux->quiz_schedule 	= self::$active;
		$ux->breadcrumbs 	= App::make('AdminQuizScheduleController')->breadcrumbs().
							  		    '<li class="active"><i class="fa fa-list"></i> SET SCHEDULE LIST</li>';

		$schedules = QuizSchedule::with(array('quiz'))
								 ->where('quiz_id', '=', $quiz_id)
								 ->get();

		return View::make('administrator.quiz-schedule.index')
				   ->with('quiz_id', $quiz_id)
				   ->with('schedules', $schedules)
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

		$ux->quiz 		 	= self::$active;
		$ux->quiz_schedule 	= self::$active;
		$ux->breadcrumbs 	= App::make('AdminQuizScheduleController')->breadcrumbs().
							 		  	'<li class="active"><a href="'.URL::to('administrator/quiz/'.$quiz_id.'/schedule').'"><i class="fa fa-list"></i> SET SCHEDULE LIST</li></a>
									   	<li class="active"><i class="fa fa-plus"></i> ADD SCHEDULE</li>';

		return View::make('administrator.quiz-schedule.create')
				   ->with('quiz_id', $quiz_id)
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

		$validator = QuizSchedule::validate(Input::all());

		if ($validator->passes()) {
			// S: FORMAT INPUT TIME TO MYSQL FORMAT
			$from 	= date('Y-m-d H:i:s', strtotime(Input::get('from')));
			$to 	= date('Y-m-d H:i:s', strtotime(Input::get('to')));
			// E: FORMAT INPUT TIME TO MYSQL FORMAT

	        $schedule = new QuizSchedule(array(
	         	'quiz_id'		=> $quiz_id,
	        	'from'			=> $from,
	         	'to'			=> $to,
	         	'slots'			=> Input::get('slots'),
	         	'allow_to_take' => Input::get('allow')
	        ));
	        $schedule->save();
	        
	        Session::flash('message', 'Schedule set successfully.');
	        Session::flash('class', 'alert-success');

	        return Redirect::to('administrator/quiz/'.$quiz_id.'/schedule');
	   	} else {
	        return Redirect::to('administrator/quiz/'.$quiz_id.'/schedule/create')
	        			   ->withErrors($validator)
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
	public function edit($quiz_id, $schedule_id)
	{
		if (!Account::check_admin_session()) {
			return View::make('admin.login');
		} 

		$ux = new StdClass();

		$ux->quiz 		 	= self::$active;
		$ux->quiz_schedule 	= self::$active;
		$ux->breadcrumbs 	= App::make('AdminQuizScheduleController')->breadcrumbs().
							 		  	'<li class="active"><a href="'.URL::to('administrator/quiz/'.$quiz_id.'/schedule').'"><i class="fa fa-list"></i> SET SCHEDULE LIST</li></a>
									   	<li class="active"><i class="fa fa-edit"></i> EDIT SCHEDULE</li>';
        $schedule = QuizSchedule::find($schedule_id);

    	return View::make('administrator.quiz-schedule.edit')
    			   ->with('quiz_id', $quiz_id)
    			   ->with('schedule', $schedule)
				   ->with('ux', $ux);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($quiz_id, $schedule_id)
	{
		if (!Account::check_admin_session()) {
			return View::make('admin.login');
		} 

		$validator = QuizSchedule::validate(Input::all());

	    if ($validator->passes()) {
			// S: FORMAT INPUT TIME TO MYSQL FORMAT
			$from 	= date('Y-m-d H:i:s', strtotime(Input::get('from')));
			$to 	= date('Y-m-d H:i:s', strtotime(Input::get('to')));
			// E: FORMAT INPUT TIME TO MYSQL FORMAT

            $schedule           	  = QuizSchedule::find($schedule_id);
            $schedule->from     	  = $from;
            $schedule->to 			  = $to;
            $schedule->slots 		  = Input::get('slots');
            $schedule->allow_to_take  = Input::get('allow');
            $schedule->save();

	        Session::flash('message', 'Schedule set successfully.');
	        Session::flash('class', 'alert-success');

	        return Redirect::to('administrator/quiz/'.$quiz_id.'/schedule');
	   	} else {
	        return Redirect::to('administrator/quiz/'.$quiz_id.'/schedule/'.$schedule_id.'/edit')
	        			   ->withErrors($validator)
						   ->withInput();
	    }
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($quiz_id, $schedule_id)
	{
		if (!Account::check_admin_session()) {
			return View::make('admin.login');
		} 
		
		$schedule = QuizSchedule::find($schedule_id);

		$schedule->delete();

		Session::flash('message', 'Selected schedule successfully deleted.');
		Session::flash('class', 'alert-success');

		return Redirect::to('administrator/quiz/'.$quiz_id.'/schedule');
	}

	public function updateChoiceAnswer()
	{
		if (!Account::check_admin_session()) {
			return View::make('admin.login');
		} 
		
 		if (Request::ajax()) {
			$question_choice = DB::table('question_choice')
								 ->where('question_id', '=', $_POST['question_id'])
			  					 ->where('choice_id', '=', $_POST['choice_id']);
	        $question_choice->update(array(
	        	'answer' => ($_POST['answer'] == 1) ? 0 : 1
	        ));

	        $response[0] = ($_POST['answer'] == 1) ? 'correct' : 'wrong';
	        $response[1] = ($_POST['answer'] == 1) ? 'wrong' : 'correct';
	        $response[2] = ($_POST['answer'] == 1) ? 'fa fa-times' : 'fa fa-check';
	        $response[3] = ($_POST['answer'] == 1) ? 'fa fa-check' : 'fa fa-times';
	        $response[4] = ($_POST['answer'] == 1) ? 0 : 1;

 			return $response;
    	}
    	
    	return "INVALID REQUEST";
	}

	public function breadcrumbs()
	{
		return '<li><a href="'.URL::to('administrator').'"><i class="fa fa-dashboard"></i> DASHBOARD</a></li>
				<li><i class="fa fa-certificate"></i> SCHOLARSHIP</li>
                <li><i class="fa fa-pencil"></i> EXAMINATION</li>
                <li><a href="'.URL::to('administrator/quiz').'"><i class="fa fa-list"></i> EXAMINATION LIST</a></li>
				<li><i class="fa fa-calendar"></i> SET SCHEDULE</li>';
	}
}