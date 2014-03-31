<?php

class AdminAnnouncementController extends BaseController {
	public function index() {
		$ann = Announcement::all();

		return View::make('announcement.index', compact('ann'));
	}

	public function create() {
		return View::make('announcement.create');
	}

	public function store() {
		$val = Validator::make(Input::all(), ['subject' => 'required', 'description' => 'required'] );

		if ($val->passes()) {
			$ann = Announcement::find(1);

			$ann->subject     = Input::get('subject');
			$ann->description = Input::get('description');

			$ann->save();

			return Redirect::route('announce.index')->with('action', 'ANNOUNCEMENT_SUCCESS');	
		} else {
			return Redirect::back()->withInput()->withErrors($val);	
		}
	}
}