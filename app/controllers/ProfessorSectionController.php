<?php

class ProfessorSectionController extends BaseController{

	public function index()
	{
		$users = DB::table('vw_professor_section_count')->get();
		$count = Administrator::user_count();

		return View::make('professor.section.index', compact('users', 'count'));
	}

	public function create($id)
	{
		$prof = DB::table('instructor')->where('id', $id)->first();
		$secs = Section::all()->toArray();
		
		$i = 0;
		foreach ($secs as $sec) {
			$s = DB::table('vw_professor_section_list')->where('id', $id)->where('section_id', $sec['id'])->count();
			if ($s) {
                $secs[$i] = array_add($secs[$i],'enrolled', 'YES');
			} else {
                $secs[$i] = array_add($secs[$i],'enrolled', 'NO');
			}
			$i++;
		}

		return View::make('professor.section.create', compact('prof', 'secs'));
	}

	public function store($prof_id, $sec_id)
	{
		DB::table('instructor_section')->insert([
			'instructor_id' => $prof_id,
			'section_id'    => $sec_id,
			'subject_id'    => 1
        ]);

        return Redirect::route('prof_sec.create', $prof_id)->with('action', 'PROFESSOR_SECTION_CREATE_SUCCESS');

	}

	public function show($id)
	{
		$prof = DB::table('instructor')->where('id', $id)->first();
		$secs = DB::table('vw_professor_section_list')->where('id', $id)->get();

		return View::make('professor.section.show', compact('prof', 'secs'));
	}

	public function delete($prof_id, $sec_id)
	{
		return View::make('professor.section.unenroll', compact('prof_id', 'sec_id'));
	}

	public function destroy($prof_id, $sec_id)
	{
		DB::table('instructor_section')->where('instructor_id', $prof_id)->where('section_id', $sec_id)->delete();

        return Redirect::route('sec.show', $sec_id)->with('action', 'PROFESSOR_SECTION_DELETE_SUCCESS');;
	}
}