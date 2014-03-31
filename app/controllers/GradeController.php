<?php

class GradeController extends BaseController {
	public function index()
	{
		$id = Session::get('user_id');

		$prof = DB::table('account')->where('id', $id)->first();

		/* Select all sections handled by the professor, if admin - all */
		
		if ($id == 1) {
			/* Select all sections */
			$secs = DB::table('vw_administrator_section_list_count')->get();
		} else {
			/* Select specific section for teachers */
			$secs = DB::table('vw_professor_section_list_count')->where('user_id', $id)->get();
		}

		/* Display the section list to edit. */
		return View::make('grade.index', compact('secs', 'prof'));
	}

	public function show($sec_id)
	{
		$sec = Section::find($sec_id);

		/* List of students and textboxes */
		$studs = DB::table('vw_section_student')->where('id', $sec_id)->get();

		return View::make('grade.show', compact('sec', 'studs'));
	}

	public function encoder($sec_id, $stud_id)
	{
		$sec  = Section::find($sec_id);
		$stud = Student::find($stud_id);

		/* Get previous grade */
		$grade = DB::table('vw_student_subject_grade')->where('student_id', $stud_id)->get();

		return View::make('grade.encode', compact('sec', 'stud', 'grade'));
	}

	public function store($sec_id, $stud_id)
	{

		$val = Validator::make(Input::all(), [] );

		if ($val->passes()) {
			Grade::update_grade($sec_id, $stud_id);

			return Redirect::route('grade.encode', [$sec_id, $stud_id])->with('action', 'STUDENT_GRADE_UPDATE_SUCESS');
		} else {
			return Redirect::back()->withInput()->withErrors($val);
		}		
	}

	public function student_grade()
	{
		$stud_id = Session::get('user_id');
		$stud = DB::table('student')->where('id', $stud_id)->first();
		$grade = DB::table('vw_student_subject_grade')->where('student_id', $stud_id)->get();

		$count = DB::table('student_grade')->where('student_id', $stud_id)->count() / 4;

		$ave1 = 0;
		foreach ($grade as $g) {
			if ($g->school_year == 1) {
				$ave1 += $g->score;
			}
		}
		$ave1 = $ave1/$count;

		$ave2 = 0;
		foreach ($grade as $g) {
			if ($g->school_year == 2) {
				$ave2 += $g->score;
			}
		}
		$ave2 = $ave2/$count;

		$ave3 = 0;
		foreach ($grade as $g) {
			if ($g->school_year == 3) {
				$ave3 += $g->score;
			}
		}
		$ave3 = $ave3/$count;

		$ave4 = 0;
		foreach ($grade as $g) {
			if ($g->school_year == 4) {
				$ave4 += $g->score;
			}
		}
		$ave4 = $ave4/$count;

		$gpa = ($ave1 + $ave2 + $ave3 + $ave4) / 4;

		return View::make('student.grade.view', compact('stud', 'grade', 'ave1', 'ave2', 'ave3', 'ave4', 'gpa'));
	}
}