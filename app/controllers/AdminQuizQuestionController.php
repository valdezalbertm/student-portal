<?php

class AdminQuizQuestionController extends \BaseController {
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
		$ux->quiz_question 	= self::$active;
		$ux->breadcrumbs 	= App::make('AdminQuizQuestionController')->breadcrumbs().
							  '<li class="active"><a href="'.URL::to('administrator/quiz/'.$quiz_id.'/question').'"><i class="fa fa-list"></i> QUESTION LIST</li></a>';
		
		$questions = QuizQuestion::with(array('subject', 
											  'question', 
											  'question.question_choice', 
											  'question.question_choice.choice',
											  'question.question_type'))
								 ->where('quiz_id', '=', $quiz_id)->get();

		return View::make('administrator.question.index')
				   ->with('quiz_id', $quiz_id)
				   ->with('questions', $questions)
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
		$ux->quiz_question 	= self::$active;
		$ux->breadcrumbs 	= App::make('AdminQuizQuestionController')->breadcrumbs().
						 	  '<li class="active"><i class="fa fa-plus"></i> ADD QUESTION</li>';

		foreach (QuestionType::all() as $question_type) {
			$question_types[$question_type->id] = Str::upper($question_type->name);
		}

		foreach (Subject::all() as $subject) {
			$subjects[$subject->id] = Str::upper($subject->name);
		}

		return View::make('administrator.question.create')
				   ->with('question_types', $question_types)
				   ->with('subjects', $subjects)
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

		$validator = QuizQuestion::validate(Input::all());

	    if ($validator->passes()) {
	        $question = new Question(array(
	         	'content'			=> Input::get('content'),
	         	'question_type_id'	=> Input::get('question_type_id')
	        ));
	        $question->save();

	        $question->quiz_question()->save(new QuizQuestion(array(
	        	'quiz_id' 		=> $quiz_id,
	         	'subject_id'	=> Input::get('subject_id')
	        )));
	        
	        Session::flash('message', 'Question added successfully.');
	        Session::flash('class', 'alert-success');

	        return Redirect::to('administrator/quiz/'.$quiz_id.'/question/');
	    } else {
	        return Redirect::to('administrator/quiz/'.$quiz_id.'/question/create')
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
	public function show()
	{
		// USE MODAL ON SHOW
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $quiz_id, $question_id
	 * @return Response
	 */
	public function edit($quiz_id, $question_id)
	{
		if (!Account::check_admin_session()) {
			return View::make('admin.login');
		} 

		$ux = new StdClass();

		$ux->quiz 			= self::$active;
		$ux->quiz_question 	= self::$active;
		$ux->breadcrumbs 	= App::make('AdminQuizQuestionController')->breadcrumbs().
							  	   '<li class="active"><a href="'.URL::to('administrator/quiz/'.$quiz_id.'/question').'"><i class="fa fa-list"></i> QUESTION LIST</li></a>
									<li class="active"><i class="fa fa-edit"></i> EDIT QUIZ</li>';

		$question = QuizQuestion::with(array('question',
											 'subject'))
								->where('quiz_id', '=', $quiz_id)
								->where('question_id', '=', $question_id)
								->first(); 

								// return $question;
		foreach (QuestionType::all() as $question_type) {
			$question_types[$question_type->id] = Str::upper($question_type->name);
		}

		foreach (Subject::all() as $subject) {
			$subjects[$subject->id] = Str::upper($subject->name);
		}

    	return View::make('administrator.question.edit')
    			   ->with('quiz_id', $quiz_id)
    			   ->with('question_id', $question_id)
    			   ->with('question', $question)
    			   ->with('question_types', $question_types)
				   ->with('subjects', $subjects)
    			   ->with('ux', $ux);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $quiz_id, $question_id
	 * @return Response
	 */
	public function update($quiz_id, $question_id)
	{
		if (!Account::check_admin_session()) {
			return View::make('admin.login');
		} 

		$validator = QuizQuestion::validate(Input::all());

	    if ($validator->passes()) {
			$quiz_question = DB::table('quiz_question')
							   ->where('quiz_id', '=', $quiz_id)
			  				   ->where('question_id', '=', $question_id);

	        $quiz_question->update(array(
	         	'subject_id'	=> Input::get('subject_id')
	        ));

            $question           		= Question::find($question_id);
            $question->content 			= Input::get('content');
            $question->question_type_id	= Input::get('question_type_id');
            $question->save();
	        
	        Session::flash('message', 'Question updated successfully.');
	        Session::flash('class', 'alert-success');

			return Redirect::to('administrator/quiz/'.$quiz_id.'/question/');
	    } else {
	        return Redirect::to('administrator/quiz/'.$quiz_id.'/question/'.$question_id.'/edit')
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
	public function destroy($quiz_id, $question_id)
	{
		if (!Account::check_admin_session()) {
			return View::make('admin.login');
		} 
		
		$question 	= Question::find($question_id);
		$title	 	= $question->title;

		$question = QuizQuestion::where('quiz_id', '=', $quiz_id)
								->where('question_id', '=', $question_id);

		$question->delete();

		Session::flash('message', $title.' successfully deleted.');
		Session::flash('class', 'alert-success');
		return Redirect::to('administrator/quiz/'.$quiz_id.'/question');
	}

	public function breadcrumbs()
	{
		return '<li><a href="'.URL::to('administrator').'"><i class="fa fa-dashboard"></i> DASHBOARD</a></li>
				<li><i class="fa fa-certificate"></i> SCHOLARSHIP</li>
                <li><i class="fa fa-pencil"></i> EXAMINATION</li>
                <li><a href="'.URL::to('administrator/quiz').'"><i class="fa fa-list"></i> EXAMINATION LIST</a></li>
				<li><i class="fa fa-question"></i> MANAGE QUESTION</li>';
	}

	public function indexAjax($quiz_id)
	{
		// if (Request::ajax()) {
			$questions = QuizQuestion::with(array('subject', 
												  'question', 
												  'question.question_choice', 
												  'question.question_choice.choice',
												  'question.question_type'))
									 ->where('quiz_id', '=', $quiz_id)
									 ->get();
 			return $questions;
	 	// }
	}

	public function storeAjax($quiz_id) 
	{
		if (Request::ajax()) {
			$data = json_decode(file_get_contents("php://input"));

	        $question = new Question(array(
	         	'content'			=> $data->question,
	         	'question_type_id'	=> '3'
	        ));
	        $question->save();

	        $question->quiz_question()->save(new QuizQuestion(array(
	        	'quiz_id' 		=> $quiz_id,
	         	'subject_id'	=> '3'
	        )));
	       
	        return "success";
	    }
	}

	public function destroyAjax($quiz_id, $question_id) 
	{
		if (Request::ajax()) {
			$question 	= Question::find($question_id);
			$title	 	= $question->title;

			$question = QuizQuestion::where('quiz_id', '=', $quiz_id)
									->where('question_id', '=', $question_id);

			$question->delete();
		}
	}
}