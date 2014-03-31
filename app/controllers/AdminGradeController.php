<?php

class AdminGradeController extends \BaseController {
	public function index()
	{
		$studs = DB::table('vw_student_list')->get();

		return View::make('admin.grade.index', compact('studs'));
	}

	public function view($id)
	{
		$stud_id = $id;

		$stud = DB::table('student')->where('id', $stud_id)->first();
		$grade = DB::table('student_grade')->where('student_id', $stud_id)->get();

		$ave1 = 0;
		for ($i=0; $i <= 7; $i++) {
			$ave1 = $grade[$i]->score + $ave1;
		}
		$ave1 = $ave1/8;

		$ave2 = 0;
		for ($i=8; $i <= 15; $i++) {
			$ave2 = $grade[$i]->score + $ave2;
		}
		$ave2 = $ave2/8;

		$ave3 = 0;
		for ($i=16; $i <=23; $i++) {
			$ave3 = $grade[$i]->score + $ave3;
		}
		$ave3 = $ave3/8;

		$ave4 = 0;
		for ($i=24; $i <=31; $i++) {
			$ave4 = $grade[$i]->score + $ave4;
		}
		$ave4 = $ave4/8;

		$gpa = ($ave1 + $ave2 + $ave3 + $ave4) / 4;

		return View::make('admin.grade.view', compact('stud', 'grade', 'ave1', 'ave2', 'ave3', 'ave4', 'gpa'));
	}
}
