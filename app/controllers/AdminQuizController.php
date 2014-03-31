<?php

class AdminQuizController extends \BaseController {
	public static $active = 'open';
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{	
		if (!Account::check_admin_session()) {
			return View::make('admin.login');
		} 

		$ux = new StdClass();

		$ux->quiz 		 = self::$active;
		$ux->breadcrumbs = App::make('AdminQuizController')->breadcrumbs().'<li class="active"><i class="fa fa-list"></i> EXAMINATION LIST</li>';
		
		$quizzes		= Quiz::all();

		return View::make('administrator.quiz.index')->with('quizzes', $quizzes)
		 											 ->with('ux', $ux);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if (!Account::check_admin_session()) {
			return View::make('admin.login');
		} 

		$ux = new StdClass();

		$ux->quiz 		 = self::$active;
		$ux->breadcrumbs = App::make('AdminQuizController')->breadcrumbs().'<li><a href="'.URL::to('administrator/quiz').'"><i class="fa fa-list"></i> EXAMINATION LIST</a></li>
																			<li class="active"><i class="fa fa-plus"></i> ADD EXAMINATION</li>';

		return View::make('administrator.quiz.create')->with('ux', $ux);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if (!Account::check_admin_session()) {
			return View::make('admin.login');
		} 

		$validator = Quiz::validate(Input::all());

	    if ($validator->passes()) {
	        Quiz::create(array(
	        	'title'			=> Input::get('title'),
	         	'description'	=> Input::get('description'),
	         	'instruction'	=> Input::get('instruction'),
	         	'time_limit'	=> Input::get('time_limit')
	        ));

	        Session::flash('message', Input::get('title').' added successfully.');
	        Session::flash('class', 'alert-success');

	        return Redirect::to('administrator/quiz');
	    } else {
	        return Redirect::to('administrator/quiz/create')->withErrors($validator)
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
		// USE MODAL ON SHOW
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		if (!Account::check_admin_session()) {
			return View::make('admin.login');
		} 

		$ux = new StdClass();

		$ux->quiz 			= self::$active;
		$ux->breadcrumbs	= App::make('AdminQuizController')->breadcrumbs().'<li><a href="'.URL::to('administrator/quiz').'"><i class="fa fa-list"></i> EXAMINATION LIST</a></li>
		                    	   		   	   								   <li class="active"><i class="fa fa-edit"></i> EDIT EXAMINATION</li>';
        $quiz = Quiz::find($id);

    	return View::make('administrator.quiz.edit')
    			   ->with('quiz', $quiz)
				   ->with('ux', $ux);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		if (!Account::check_admin_session()) {
			return View::make('admin.login');
		} 

		$validator = Quiz::validate(Input::all());

	    if ($validator->passes()) {
            $quiz           	= Quiz::find($id);
            $quiz->title     	= Input::get('title');
            $quiz->description 	= Input::get('description');
            $quiz->instruction 	= Input::get('instruction');
            $quiz->time_limit 	= Input::get('time_limit');
            $quiz->save();

	        Session::flash('message', Input::get('title').' successfully updated.');
	        Session::flash('class', 'alert-success');

	        return Redirect::to('administrator/quiz');
	    } else {
	        return Redirect::to('administrator/quiz/'.$id.'/edit')->withErrors($validator)
	        													  ->withInput();
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
		if (!Account::check_admin_session()) {
			return View::make('admin.login');
		} 

		$quiz 	= Quiz::find($id);
		$title 	= $quiz->title;
		
		$quiz->delete();

		Session::flash('message', $title.' successfully deleted.');
		Session::flash('class', 'alert-success');
		return Redirect::to('administrator/quiz');
	}

	public function breadcrumbs()
	{
		return '<li><a href="'.URL::to('administrator').'"><i class="fa fa-dashboard"></i> DASHBOARD</a></li>
				<li><i class="fa fa-certificate"></i> SCHOLARSHIP</li>
                <li><i class="fa fa-pencil"></i> EXAMINATION</li>';
	}
}