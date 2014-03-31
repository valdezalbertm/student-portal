<?php

class StudentPortalController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function home($id = "1")
	{
		$students = DB::table('student')->where("id",$id)->get();
		// var_dump($students);
		// echo "<pre>";
		// 	var_dump(URL::route('profile'));
		// 	var_dump(Route::currentRouteName());
		// 	var_dump(Input::all());
		// 	var_dump(Input::has('name'));

		// 	// echo app_path()."\assets\css";
		// 	echo link_to('css/bootstrap.css', $title = "Hello", $attributes = array(), $secure = null);
		// echo "</pre>";
		//flash Inputs
		Input::flashExcept('password');
		// return "Hello po";
		$name = "Ate Ging ".URL::to('home/about')." ".$id;
		return View::make('hello')->with('name',Input::get('name'));
	}

	public function listType($type)
	{
		$account_type = AccountType::select('id')->where('name',$type)->get()->first();
		if($account_type){
			return View::make("users.accounts")->withAccounts($account_type->accounts)->withType($type);
		}else{
			return "Nothing Here";
		}
	}

	public function addAccount()
	{
		$account = new Account;
		$account->account_type_id = 1;
		$account->username = "Marlo";
		$account->password = Hash::make("Marlo");
		$account->save();
		// return $account->id;

		//get account type
		$account_type;
			$student = new Student(
				array(
					'student_number'	=> '200810104', 
					'firstname'	=> 'Marlo', 
					'middlename'	=> 'ALA', 
					'lastname'	=> 'Corridor', 
					'year_level_id'	=> '1', 
					'birthdate'	=> '1991-10-20',
					'gender'	=> 'male', 
					'contact'	=> '0909090909', 
					'email'	=> 'a@a.com'
				));

			echo Student::all(), Account::all(), Instructor::all();
			$student = $account->student()->save($student);
			return array($student->id,$account->id);
	}

}