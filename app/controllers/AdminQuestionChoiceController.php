<?php

class AdminQuestionChoiceController extends \BaseController {
	public static $active = 'open';
	/**
	 * Display a listing of the resource.
	 *
	 * @param  int  $quiz_id, $question_id
	 * @return Response
	 */
	public function index($quiz_id, $question_id)
	{
		if (!Account::check_admin_session()) {
			return View::make('admin.login');
		} 

		$ux = new StdClass();

		$ux->quiz 		 		= self::$active;
		$ux->quiz_question 		= self::$active;
		$ux->question_choice 	= self::$active;
		$ux->breadcrumbs 		= App::make('AdminQuestionChoiceController')
									 ->breadcrumbs($quiz_id, $question_id);

		$choices = QuestionChoice::with(array('choice'))
								 ->where('question_id', '=', $question_id)
								 ->get();

		//return $choices;
		return View::make('administrator.choice.index')
				   ->with('quiz_id', $quiz_id)
				   ->with('question_id', $question_id)
				   ->with('choices', $choices)
				   ->with('ux', $ux);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @param  int  $quiz_id, $question_id
	 * @return Response
	 */
	public function create($quiz_id, $question_id)
	{
		if (!Account::check_admin_session()) {
			return View::make('admin.login');
		} 

		$ux = new StdClass();

		$ux->quiz 		 		= self::$active;
		$ux->quiz_question 		= self::$active;
		$ux->question_choice 	= self::$active;
		$ux->breadcrumbs 		= App::make('AdminQuestionChoiceController')->breadcrumbs($quiz_id, $question_id).
						 	  		   '<li class="active"><i class="fa fa-plus"></i> ADD CHOICE</li>';

		return View::make('administrator.choice.create')
				   ->with('quiz_id', $quiz_id)
				   ->with('question_id', $question_id)
				   ->with('ux', $ux);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($quiz_id, $question_id)
	{
		if (!Account::check_admin_session()) {
			return View::make('admin.login');
		} 

		$validator = Choice::validate(Input::all());

	    if ($validator->passes()) {
	        $choice = new Choice(array(
	         	'content'			=> Input::get('content')
	        ));
	        $choice->save();

	        $choice->question_choice()->save(new QuestionChoice(array(
	        	'question_id' 	=> $question_id,
	        	'answer'		=> Input::get('answer')
	        )));
	        
	        Session::flash('message', 'Choice created successfully.');
	        Session::flash('class', 'alert-success');

			return Redirect::to('administrator/quiz/'.$quiz_id.'/question/'.$question_id.'/choice');
	    } else {
	        return Redirect::to('administrator/quiz/'.$quiz_id.'/question/'.$question_id.'/choice/create')
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
	 * @param  int  $quiz_id, $question_id, $choice_id
	 * @return Response
	 */
	public function edit($quiz_id, $question_id, $choice_id)
	{
		if (!Account::check_admin_session()) {
			return View::make('admin.login');
		} 

		$ux = new StdClass();

		$ux->quiz 		 		= self::$active;
		$ux->quiz_question 		= self::$active;
		$ux->question_choice 	= self::$active;
		$ux->breadcrumbs 		= App::make('AdminQuestionChoiceController')->breadcrumbs($quiz_id, $question_id).
							  		   '<li class="active"><a href="'.URL::to('administrator/quiz/'.$quiz_id.'/question/'.$question_id.'/choice').'"><i class="fa fa-list-ul"></i> CHOICE LIST</li></a>
										<li class="active"><i class="fa fa-edit"></i> EDIT CHOICE</li>';

		$choice = QuestionChoice::with('choice')
								->where('question_id', '=', $question_id)
								->where('choice_id', '=', $choice_id)
								->first();

    	return View::make('administrator.choice.edit')
    			   ->with('quiz_id', $quiz_id)
    			   ->with('question_id', $question_id)
    			   ->with('choice_id', $choice_id)
    			   ->with('choice', $choice)
    			   ->with('ux', $ux);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $quiz_id, $question_id, $choice_id
	 * @return Response
	 */
	public function update($quiz_id, $question_id, $choice_id)
	{
		if (!Account::check_admin_session()) {
			return View::make('admin.login');
		} 

		$validator = Choice::validate(Input::all());

	    if ($validator->passes()) {
			$question_choice = DB::table('question_choice')
								 ->where('question_id', '=', $question_id)
			  					 ->where('choice_id', '=', $choice_id);
	        $question_choice->update(array(
	        	'answer' => Input::get('answer')
	        ));

            $choice 			= Choice::find($choice_id);
            $choice->content 	= Input::get('content');
            $choice->save();
	        
	        Session::flash('message', 'Choice successfully updated.');
	        Session::flash('class', 'alert-success');

			return Redirect::to('administrator/quiz/'.$quiz_id.'/question/'.$question_id.'/choice');
	    } else {
	        return Redirect::to('administrator/quiz/'.$quiz_id.'/question/'.$question_id.'/choice/'.$choice_id.'/edit')
	        			   ->withErrors($validator)
	        			   ->withInput();
	    }
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $quiz_id, $question_id, $choice_id
	 * @return Response
	 */
	public function destroy($quiz_id, $question_id, $choice_id)
	{
		if (!Account::check_admin_session()) {
			return View::make('admin.login');
		} 

		$choice = QuestionChoice::where('question_id', '=', $question_id)
								->where('choice_id', '=', $choice_id);

		$choice->delete();

		Session::flash('message', 'Selected choice successfully deleted.');
		Session::flash('class', 'alert-success');
		return Redirect::to('administrator/quiz/'.$quiz_id.'/question/'.$question_id.'/choice');
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
	
	public function breadcrumbs($quiz_id, $question_id)
	{
		return '<li><a href="'.URL::to('administrator').'"><i class="fa fa-dashboard"></i> DASHBOARD</a></li>
				<li><i class="fa fa-certificate"></i> SCHOLARSHIP</li>
                <li><i class="fa fa-pencil"></i> EXAMINATION</li>
                <li><a href="'.URL::to('administrator/quiz').'"><i class="fa fa-list"></i> EXAMINATION LIST</a></li>
				<li><i class="fa fa-question"></i> MANAGE QUESTIONS</li>
				<li><a href="'.URL::to('administrator/quiz/'.$quiz_id.'/question').'"><i class="fa fa-list"></i> QUESTION LIST</a></li>
				<li><i class="fa fa-list-ul"></i> MANAGE CHOICES</li>';
	}
}