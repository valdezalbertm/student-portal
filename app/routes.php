<?php


// CHRISTIAN

// Route::get('/', function()
// {
// 	return View::make('index');
// });

Route::get('/', array('as' => 'indexes', 'uses' => 'AdministratorController@home'));

Route::get('faqs', function()
{
	return View::make('faqs');
});

Route::get('developers', function()
{
	return View::make('developers');
});


// AJAX REQUEST
Route::post('administrator/update-choice-answer', 'AdminQuestionChoiceController@updateChoiceAnswer');
Route::post('administrator/update-scholarship-status', 'UserQuizController@updateScholarshipStatus');

// ANGULAR
Route::get('administrator/quiz/{id}/question/indexAjax', 'AdminQuizQuestionController@indexAjax');
Route::post('administrator/quiz/{id}/question/storeAjax', 'AdminQuizQuestionController@storeAjax');
Route::delete('administrator/quiz/{delete_id}/question/{question_id}/deleteAjax', 'AdminQuizQuestionController@deleteAjax');

Route::get('scholarship/quiz/{user}/{id}', 'UserQuizController@index');
Route::post('scholarship/quiz/{user}/{id}/submit', 'UserQuizController@submit');
Route::get('{user_type}/scholarship/quiz/{user}/{id}/result', 'UserQuizController@result');

Route::get('scholarship', 'UserScholarshipController@index');
Route::get('scholarship/passers', 'UserScholarshipController@passers');
Route::post('scholarship/student', 'UserScholarshipController@storeStudent');
Route::post('scholarship/applicant', 'UserScholarshipController@storeApplicant');
Route::get('scholarship/{user}/{id}/validation', 'UserScholarshipController@validation');
Route::post('scholarship/validation', 'UserScholarshipController@validationQuiz');

Route::resource('administrator/quiz.question.choice', 'AdminQuestionChoiceController');
Route::resource('administrator/quiz.question', 'AdminQuizQuestionController');
Route::resource('administrator/quiz', 'AdminQuizController');
Route::resource('administrator/quiz.scholarship', 'AdminQuizScholarshipController');
Route::resource('administrator/quiz.schedule', 'AdminQuizScheduleController');

Route::get('administrator/scholarship/reports', 'ScholarshipController@report');
Route::get('administrator/scholarship/report/{user}/print/{print}', 'ScholarshipController@printReport');
Route::delete('administrator/scholarship/report/{user}/{id}', 
	['as' => 'administrator.scholarship.report', 'uses' => 'ScholarshipController@destroyReport']);
Route::get('administrator/scholarship/quiz/exam-station-mode', 'AdminQuizScholarshipController@examStationMode');
// MARLO

//Student Penalty
Route::resource('administrator/student.penalty','StudentPenaltyController');
//Student Scholarship
Route::resource('administrator/student.scholarship','StudentScholarshipController');
// //Scholarship
Route::resource('administrator/scholarship','ScholarshipController');
// //Scholarship Discount Details
Route::resource('administrator/scholarship.discount','ScholarshipDiscountController');

// ALBERT

/* Announcement */
Route::get('administrator/announcement', ['as' => 'announce.index', 'uses' => 'AdminAnnouncementController@index']);
Route::get('administrator/announcement/create', ['as' => 'announce.create', 'uses' => 'AdminAnnouncementController@create']);
Route::post('administrator/announcement/', ['as' => 'announce.store', 'uses' => 'AdminAnnouncementController@store']);


/* Admin Year Level Administration */
Route::get('administrator/student/year', ['as' => 'admin.yr.index', 'uses' => 'AdminYearController@index'] );
Route::get('administrator/student/year/{id}', ['as' => 'admin.yr.edit', 'uses' => 'AdminYearController@edit'] );
Route::put('administrator/student/year/{id}', ['as' => 'admin.yr.update', 'uses' => 'AdminYearController@update'] );


/* Viewing of students grade for Administrator*/
Route::get('administrator/grade', ['as' => 'admin.grade.index', 'uses' => 'AdminGradeController@index'] );
Route::get('administrator/grade/{id}', ['as' => 'admin.grade.view', 'uses' => 'AdminGradeController@view'] );

/* Viewing of students grade*/
Route::get('student/grade', ['as' => 'student.grade', 'uses' => 'GradeController@student_grade'] );

/* CRUD for Grade encoding */
Route::get('grade', ['as' => 'grade.index', 'uses' => 'GradeController@index'] );
Route::get('grade/{id}', ['as' => 'grade.show', 'uses' => 'GradeController@show'] );
Route::get('grade/{id}/student/{id2}', ['as' => 'grade.encode', 'uses' => 'GradeController@encoder'] );
Route::post('grade/{id}/student/{id2}', ['as' => 'grade.store', 'uses' => 'GradeController@store'] );

//CRUD For Section_Student
Route::get('section/{id}/student/{id2}/delete', ['as' => 'sec_stud.delete', 'uses' => 'SectionController@delete_student'] );
Route::get('section/{id}/student/create', ['as' => 'sec_stud.create', 'uses' => 'SectionController@create_student'] );
Route::get('section/{id}/student/search', ['as' => 'sec_stud.search', 'uses' => 'SectionController@search_student'] );
Route::post('section/{id}/student/{id2}', ['as' => 'sec_stud.store', 'uses' => 'SectionController@store_student'] );
Route::delete('section/{id}/{id2}', ['as' => 'sec_stud.destroy', 'uses' => 'SectionController@destroy_student'] );


/* CRUD for Professor Section */
Route::post('instructor/{id}/section/{id2}', ['as' => 'prof_sec.store', 'uses' => 'ProfessorSectionController@store'] );
Route::get('instructor/{id}/section/create', ['as' => 'prof_sec.create', 'uses' => 'ProfessorSectionController@create'] );
Route::get('instructor', ['as' => 'prof_sec.index', 'uses' => 'ProfessorSectionController@index'] );
Route::get('instructor/{id}/section', ['as' => 'prof_sec.show', 'uses' => 'ProfessorSectionController@show'] );

Route::get('instructor/{id}/section/{id2}/delete', ['as' => 'prof_sec.delete', 'uses' => 'ProfessorSectionController@delete'] );
Route::delete('instructor/{id}/section/{id2}', ['as' => 'prof_sec.destroy', 'uses' => 'ProfessorSectionController@destroy'] );

//CRUD For Section_Student
// Route::get('section/{id}/{id2}/delete', ['as' => 'sec_stud.delete', 'uses' => 'SectionController@delete_student'] );
// Route::delete('section/{id}/{id2}', ['as' => 'sec_stud.destroy', 'uses' => 'SectionController@destroy_student'] );

//CRUD for Section
Route::get('section', ['as' => 'sec.index', 'uses' => 'SectionController@index'] );
Route::get('section/create', ['as' => 'sec.create', 'uses' => 'SectionController@create'] );

Route::post('section/search', ['as' => 'sec.search', 'uses' => 'SectionController@search'] );
Route::post('section/store', ['as' => 'sec.store', 'uses' => 'SectionController@store'] );
Route::post('section/login', ['as' => 'sec.login', 'uses' => 'SectionController@login'] );

Route::get('section/{id}/edit', ['as' => 'sec.edit', 'uses' => 'SectionController@edit'] );
Route::get('section/{id}/delete', ['as' => 'sec.delete', 'uses' => 'SectionController@delete'] );
Route::get('section/{id}', ['as' => 'sec.show', 'uses' => 'SectionController@show'] );

Route::put('section/{id}', ['as' => 'sec.update', 'uses' => 'SectionController@update'] );
Route::delete('section/{id}', ['as' => 'sec.destroy', 'uses' => 'SectionController@destroy'] );

//CRUD for Subject
Route::get('subject', array('as' => 'subj.index', 'uses' => 'SubjectController@index'));
Route::get('subject/create', array('as' => 'subj.create', 'uses' => 'SubjectController@create'));

Route::post('subject/search', array('as' => 'subj.search', 'uses' => 'SubjectController@search'));
Route::post('subject/store', array('as' => 'subj.store', 'uses' => 'SubjectController@store'));
Route::post('subject/login', ['as' => 'subj.login', 'uses' => 'SubjectController@login'] );

Route::get('subject/{id}/edit', array('as' => 'subj.edit', 'uses' => 'SubjectController@edit'));
Route::get('subject/{id}/delete', array('as' => 'subj.delete', 'uses' => 'SubjectController@delete'));
Route::get('subject/{id}', ['as' => 'subj.show', 'uses' => 'SubjectController@show'] );

Route::put('subject/{id}', ['as' => 'subj.update', 'uses' => 'SubjectController@update'] );
Route::delete('subject/{id}', ['as' => 'subj.destroy', 'uses' => 'SubjectController@destroy'] );

//CRUD for Student
Route::get('administrator/student', array('as' => 'stud.index', 'uses' => 'StudentController@index'));
Route::get('administrator/student/list', array('as' => 'stud.list', 'uses' => 'StudentController@lists'));
Route::get('administrator/student/create', array('as' => 'stud.create', 'uses' => 'StudentController@create'));
Route::get('administrator/student/logout', array('as' => 'stud.logout', 'uses' => 'StudentController@logout'));
Route::get('administrator/student/login', array('as' => 'stud.get_login', 'uses' => 'StudentController@get_login'));

Route::post('administrator/student/store', array('as' => 'stud.store', 'uses' => 'StudentController@store'));
Route::post('administrator/student/login', ['as' => 'stud.login', 'uses' => 'StudentController@login'] );

Route::get('administrator/student/{id}/edit', array('as' => 'stud.edit', 'uses' => 'StudentController@edit'));
Route::get('administrator/student/{id}/delete', array('as' => 'stud.delete', 'uses' => 'StudentController@delete'));
Route::get('administrator/student/{id}', ['as' => 'stud.show', 'uses' => 'StudentController@show'] );

Route::put('administrator/student/{id}', ['as' => 'stud.update', 'uses' => 'StudentController@update'] );
Route::delete('administrator/student/{id}', ['as' => 'stud.destroy', 'uses' => 'StudentController@destroy'] );

//CRUD for Professor
Route::get('administrator/professor', array('as' => 'prof.index', 'uses' => 'ProfessorController@index'));
Route::get('administrator/professor/create', array('as' => 'prof.create', 'uses' => 'ProfessorController@create'));
Route::get('administrator/professor/logout', array('as' => 'prof.logout', 'uses' => 'ProfessorController@logout'));
Route::get('administrator/professor/login', array('as' => 'prof.get_login', 'uses' => 'ProfessorController@get_login'));

Route::post('administrator/professor/store', array('as' => 'prof.store', 'uses' => 'ProfessorController@store'));
Route::post('administrator/professor/login', ['as' => 'prof.login', 'uses' => 'ProfessorController@login'] );

Route::get('administrator/professor/{id}/edit', array('as' => 'prof.edit', 'uses' => 'ProfessorController@edit'));
Route::get('administrator/professor/{id}/delete', array('as' => 'prof.delete', 'uses' => 'ProfessorController@delete'));
Route::get('administrator/professor/{id}', ['as' => 'prof.show', 'uses' => 'ProfessorController@show'] );

Route::put('administrator/professor/{id}', ['as' => 'prof.update', 'uses' => 'ProfessorController@update'] );
Route::delete('administrator/professor/{id}', ['as' => 'prof.destroy', 'uses' => 'ProfessorController@destroy'] );

//CRUD for Administrator
Route::get('administrator', array('as' => 'admin.index', 'uses' => 'AdministratorController@index'));
Route::get('administrator/list', ['as' => 'admin.list', 'uses' => 'AdministratorController@lists']);
Route::get('administrator/accountlist', array('as' => 'admin.account_list', 'uses' => 'AdministratorController@account_list'));
Route::get('administrator/settings', ['as' => 'admin.settings', 'uses' => 'AdministratorController@settings']);
Route::get('administrator/create', array('as' => 'admin.create', 'uses' => 'AdministratorController@create'));
Route::get('administrator/logout', array('as' => 'admin.logout', 'uses' => 'AdministratorController@logout'));
Route::get('administrator/login', array('as' => 'admin.get_login', 'uses' => 'AdministratorController@get_login'));

Route::post('administrator/search', array('as' => 'admin.search', 'uses' => 'AdministratorController@searcher'));
Route::post('administrator/store', array('as' => 'admin.store', 'uses' => 'AdministratorController@store'));
Route::post('administrator/login', ['as' => 'admin.login', 'uses' => 'AdministratorController@login'] );

Route::get('administrator/{id}/edit', array('as' => 'admin.edit', 'uses' => 'AdministratorController@edit'));
Route::get('administrator/{id}/delete', array('as' => 'admin.delete', 'uses' => 'AdministratorController@delete'));
Route::get('administrator/{id}', ['as' => 'admin.show', 'uses' => 'AdministratorController@show'] );

Route::put('administrator/{id}', ['as' => 'admin.update', 'uses' => 'AdministratorController@update'] );
Route::delete('administrator/{id}', ['as' => 'admin.destroy', 'uses' => 'AdministratorController@destroy'] );


HTML::macro('isActive', function($route, $text, $parent='') 
{
	if( Request::path() == $route ) {
		$active = "class = 'active'";
	}
	else {
		$active = '';
	}
	 
	return HTML::decode('<li '.$active.'>'.link_to($route, $text).'</li>');
});