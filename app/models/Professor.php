<?php

class Professor extends Eloquent {
	protected $guarded = array();

	public static $rules = array();
	public $timestamps = false;
	protected $table = 'instructor';

	public static function get_dept_list()
	{
		$depts = DB::table('department')->get();
		$dept = array();
		foreach($depts as $temp) {
			$dept = array_add($dept, $temp->id, $temp->name);
		}

		return $dept;
	}

    public static function prof_exist($id)
    {
        $ctr = Professor::where('user_id', $id)->count();

        if ($ctr == 1) {
            return true;
        } else {
            return false;
        }
    }
}
