<?php

class Grade extends Eloquent {

	public static function update_grade($sec_id, $stud_id)
	{
		$subjs = DB::table('vw_student_subject_grade')
			->select('subject_id', 'code')
			->where('student_id', $stud_id)->get();

		foreach ($subjs as $subj) {
			DB::table('student_grade')
				->where('student_id', $stud_id)
				->where('subject_id', $subj->subject_id)->update([
					'score' => Input::get($subj->code)
				]);
		}
	}

}