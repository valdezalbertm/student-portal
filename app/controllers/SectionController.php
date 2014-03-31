<?php

class SectionController extends BaseController {
	public function index()
	{
        if ( ! Account::check_admin_prof_session()) {
            Account::logout_user();
            return View::make('admin.login');
        }

        $secs = DB::table('vw_section_student_no')->orderby('year_id')->get();

        return View::make('section.index', compact('secs'));
	}

    public function create()
    {
        if ( ! Account::check_admin_prof_session()) {
            Account::logout_user();
            return View::make('admin.login');
        }

        //get  year_level_list
        $yr_lvl = Section::get_sec_list();

        return View::make('section.create', compact('yr_lvl'));
    }

    public function store()
    {
        $val = Validator::make(
            Input::all(), ['name' => 'required', 'yr_lvl' => 'exists:year_level,id'] );

        if ($val->passes()) {
            Section::create( ['name' => Input::get('name'), 'year_level_id' => Input::get('yr_lvl')]);

            Session::flash('action', 'SECTION_CREATE_SUCCESS');

            return Redirect::route('sec.index');
        } else {
            return Redirect::back()->withInput()->withErrors($val);
        }
    }

    public function show($id)
    {
        $studs = DB::table('vw_section_student')->where('id', $id)->get();
        $sec   = DB::table('vw_section_list')->where('id', $id)->first();

        return View::make('section.show', compact('sec', 'studs'));
    }

    public function edit($id)
    {
        //get  year_level_list
        $yr_lvl = Section::get_sec_list();

        $sec = DB::table('vw_section_list')->where('id', $id)->first();
        return View::make('section.edit', compact('sec', 'yr_lvl'));
    }

    public function update($id)
    {
        $val = Validator::make(Input::all(), ['name' => 'required', 'yr_lvl' => 'required']);

        if ($val->passes()) {
            $sec = Section::find($id);
            $sec->name = Input::get('name');
            $sec->year_level_id = Input::get('yr_lvl');
            $sec->save();

            Session::flash('action', 'SECTION_UPDATE_SUCCESS');

            return Redirect::route('sec.index');
        } else {
            return Redirect::back()->withInput()->withErrors($validation);
        }
    }

    public function delete($id)
    {
        //check if section exists
        if (Section::sec_exist($id)) {
            return View::make('section.delete', compact('id'));
        } else {
            //return Redirect::route('sec.index');
            return Response::make(404);
        }
    }

    public function destroy($id)
    {
        if ( ! Account::check_admin_prof_session()) {
            Account::logout_user();
            return View::make('admin.login');
        }

        Section::destroy($id);
        Session::flash('action', 'SECTION_DELETE_SUCCESS');

        return Redirect::route('sec.index');
    }

    public function create_student($id)
    {
        $sec = DB::table('vw_section_list')->where('id', $id)->first();

        $skey = Input::get('skey');
        $studs = DB::table('student')->whereRaw('id NOT IN(SELECT student_id FROM section_student)')->get();

        return View::make('section.create_student', compact('sec', 'studs'));
    }

    public function store_student($sec_id, $stud_id)
    {

        DB::table('section_student')->insert([
            'student_id'  => $stud_id,
            'section_id'  => $sec_id,
            'school_year' => 1
        ]);

        return Redirect::route('sec_stud.create', $sec_id)->with('action', 'SECTION_STUDENT_CREATE_SUCCESS');
    }

    public function search_student($id)
    {
        $sec = DB::table('vw_section_list')->where('id', $id)->first();

        $skey = Input::get('skey');
        $studs = DB::table('student')->toArray();

        $sid = $id;
        $i = 0;
        foreach ($studs as $t) {
            $s = DB::table('vw_section_student')->where('id', $sid)->where('student_id', $studs[$i]['id'])->count();
            if ($s) {
                $studs[$i] = array_add($studs[$i],'enrolled', 'YES');
            } else {
                $studs[$i] = array_add($studs[$i],'enrolled', 'NO');
            }
            $i++;
        }

        return View::make('section.search_student', compact('sec', 'studs'));
    }

    public function delete_student($sec_id, $stud_id)
    {
        if ( ! Account::check_admin_prof_session()) {
            Account::logout_user();
            return View::make('admin.login');
        }

        /* check if section and student exists */
        if (Section::sec_stud_exist($sec_id, $stud_id)) {
            return View::make('section.delete_student', compact('sec_id', 'stud_id'));
        } else {
            return Redirect::route('admin.index');
        }
    }

    public function destroy_student($sec_id, $stud_id)
    {
        if ( ! Account::check_admin_prof_session()) {
            Account::logout_user();
            return View::make('admin.login');
        }

        DB::table('section_student')->where('section_id', $sec_id)->where('student_id', $stud_id)->delete();
        Session::flash('action', 'SECTION_STUDENT_DELETE_SUCCESS');

        return Redirect::route('sec.show', $sec_id);
    }
}