<?php

class ScholarshipDiscountController extends \BaseController {

	public $rules = array(
        'scholarship_id' => 'required|integer',
        'type'    	     => 'required|in:fix,percentage',
        'value'   		 => 'required|integer',
        'school_year'    => 'required|exists:school_year,name|unique:scholarship_discount,school_year,NULL,id,scholarship_id,'
    );

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
	    //check hash_key to database and account_type
		if (Account::check_admin_session()) {
			
		//
		} else {
			return View::make('admin.login');
		}
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @param  int $scholarship
	 * @return Response
	 */
	public function create($scholarship)
	{
	    //check hash_key to database and account_type
		if (Account::check_admin_session()) {	
			
		//prepare schoolyear
		$schoolyear = SchoolYear::get(array('name'));
		$schoolyear = array_fetch($schoolyear->toArray(),'name');
		$schoolyear_temp = array();
		foreach ($schoolyear as $value) {
			$schoolyear_temp[$value] = $value;
		}
		$schoolyear = $schoolyear_temp;

		$scholarship = Scholarship::find($scholarship);
		return View::make('scholarship.details.create')
			->withScholarship($scholarship)
			->withSchoolYear($schoolyear);
		} else {
			return View::make('admin.login');
		}
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  int $scholarship
	 * @return Response
	 */
	public function store($scholarship)
	{
	    //check hash_key to database and account_type
		if (Account::check_admin_session()) {
			
		//set school_year rule
		$this->rules['school_year'] .= $scholarship;
		$scholarship = Scholarship::find($scholarship);

		$validator = Validator::make(
			Input::all(),
			$this->rules
		);

		//get the validator value, because after saving the new record, the validator could fail
		$validator_fails = $validator->fails();

		if ($validator_fails)
		{
			// The given data did not pass validation
			//set message
			$msg_class 	= 'alert alert-dismissable alert-danger';
			$msg 		= '<strong>Submission fails!</strong> '.$validator->messages()->first();

			//flash Inputs
			Input::flash();
		}else{

			$discount = new ScholarshipDiscount(Input::all());
			if($scholarship->discount()->save($discount)){
				//set message
				$msg_class 	= 'alert alert-dismissable alert-success';
				$msg 		= '<strong>Well done!</strong> Scholarship Discount Details has been added successfully.';
			}else{
				//set message
				$msg_class 	= 'alert alert-dismissable alert-warning';
				$msg 		= '<strong>System Error!</strong> <em>Valid</em> Scholarship Discount Details could not be saved.';
			}
			
		}
		//message
		Session::flash('class', $msg_class);
		Session::flash('message', $msg);

		//redirect
		return Redirect::route(
			$validator_fails ? 
				'administrator.scholarship.discount.create':
				'administrator.scholarship.show'
			,$scholarship->id);
		} else {
			return View::make('admin.login');
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
	    //check hash_key to database and account_type
		if (Account::check_admin_session()) {
			
		//
		} else {
			return View::make('admin.login');
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $scholarship
	 * @param  int  $discount
	 * @return Response
	 */
	public function edit($scholarship,$discount)
	{
	    //check hash_key to database and account_type
		if (Account::check_admin_session()) {
			
		//prepare schoolyear for select
		$schoolyear = SchoolYear::get(array('name'));
		$schoolyear = array_fetch($schoolyear->toArray(),'name');
		$schoolyear_temp = array();
		foreach ($schoolyear as $value) {
			$schoolyear_temp[$value] = $value;
		}
		$schoolyear = $schoolyear_temp;

		//get data
		$scholarship = Scholarship::find($scholarship);
		$discount    = $scholarship->discount()->find($discount);		

		return View::make('scholarship.details.edit')
			->withScholarship($scholarship)
			->withDiscount($discount)
			->withSchoolYear($schoolyear);
		} else {
			return View::make('admin.login');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $scholarship
	 * @param  int  $discount
	 * @return Response
	 */
	public function update($scholarship,$discount)
	{
	    //check hash_key to database and account_type
		if (Account::check_admin_session()) {
			
		$scholarship = Scholarship::find($scholarship);
		$validator = Validator::make(
			Input::all(),
			$this->rules
		);

		if ($validator->fails())
		{
			// The given data did not pass validation
			//set message
			$msg_class 	= 'alert alert-dismissable alert-danger';
			$msg 		= '<strong>Submission fails!</strong> '.$validator->messages()->first();

			//flash Inputs
			Input::flash();
		}else{
			//update fields
			$discount = $scholarship->discount()->find($discount);
			$discount->type  = Input::get('type');
			$discount->value = Input::get('value');
			$discount->school_year = Input::get('school_year');
			
			if($scholarship->discount()->save($discount)){
				//set message
				$msg_class 	= 'alert alert-dismissable alert-success';
				$msg 		= '<strong>Well done!</strong> Scholarship Discount Details has been edited successfully.';
			}else{
				//set message
				$msg_class 	= 'alert alert-dismissable alert-warning';
				$msg 		= '<strong>System Error!</strong> <em>Valid</em> Scholarship Discount Details could not be saved.';
			}
			
		}

		//message
		Session::flash('class', $msg_class);
		Session::flash('message', $msg);

		//redirect
		return 
			Redirect::route(
				$validator->fails() ? 'administrator.scholarship.discount.edit':'administrator.scholarship.show', 
				array($scholarship->id,$discount->id)
			);
		} else {
			return View::make('admin.login');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $scholarship
	 * @param  int  $discount
	 * @return Response
	 */
	public function destroy($scholarship,$discount)
	{
	    //check hash_key to database and account_type
		if (Account::check_admin_session()) {
			
		//get data
		$scholarship = Scholarship::find($scholarship);
		$discount    = $scholarship->discount()->find($discount);

		//delete
		if ($discount->delete()) {
			//set message
			$msg_class 	= 'alert alert-dismissable alert-success';
			$msg 		= '<strong>Well done!</strong> Scholarship Discount for: \''.$discount->school_year.'\' has been deleted';
		}else {
			//set message
			$msg_class 	= 'alert alert-dismissable alert-danger';
			$msg 		= '<strong>Scholarship Discount not deleted!</strong> 
				Try submitting <strong>Discount for: \''.$discount->school_year.'\'</strong> again.';
		}

		//message
		Session::flash('class', $msg_class);
		Session::flash('message', $msg);

		//log

		//redirect
		return Redirect::route('administrator.scholarship.show',$scholarship->id);
		} else {
			return View::make('admin.login');
		}
	}

}