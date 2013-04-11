<?php

class TimetableController extends BaseController {
	public function getIndex(){
		//Return all the rows of the timetable
	}

	public function getNew(){
		//Return a view to make a new time assignment
	}

	public function postNew(){
		//Create a new row in the timetable

	}

	public function getDelete($id){
		//Return a view to verify deletion
	}

	public function postDelete(){
		Class_::find($id)->delete();
		return Redirect::action('ClassController@getIndex')
			->with('success','Tíma hent!');
	}

	public function getEdit($id){
		return View::make('admin.classes.edit')
			->with('room',Class_::find($id));
	}

	public function postEdit($id){
		$room = Class_::find($id);
		$room->name = Input::get('name');
		$room->description = Input::get('description');
		$room->save();
		return Redirect::action('ClassController@getIndex')
			->with('success','Tími vistaður!');
	}
}