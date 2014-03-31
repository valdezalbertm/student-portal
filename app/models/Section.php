<?php

class Section extends Eloquent {
    protected $guarded   = array();
    public static $rules = array('id', 'name');
    public $timestamps   = false;
    protected $table     = 'section';

    public static function get_sec_list()
    {
        $secs = DB::table('year_level')->get();
        $sec = array();
        foreach($secs as $temp) {
            $sec = array_add($sec, $temp->id, $temp->name);
        }

        return $sec;
    }

    public static function sec_exist($id)
    {
        $ctr = Section::where('id', $id)->count();

        if ($ctr == 1) {
            return true;
        } else {
            return false;
        }
    }

    public static function sec_stud_exist($sec_id, $stud_id)
    {
        $ctr = DB::table('section_student')->where('section_id', $sec_id)->where('student_id', $stud_id)->count();

        if ($ctr == 1) {
            return true;
        } else {
            return false;
        }
    }

}