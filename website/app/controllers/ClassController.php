<?php

class ClassController extends BaseController {
	public function getIndex(){
		return View::make('admin.classes')
			->with('classes',Class_::all());
	}

	public function getNew(){
		return View::make('admin.classes.new');
	}

	public function postNew(){
		$room = new Class_;
		$room->name = Input::get('name');
		$room->description = Input::get('description');
		$room->save();

		return Redirect::action('ClassController@getIndex')
			->with('success','Tími skráður!');

	}

	public function getDelete($id){
		return View::make('admin.classes.delete')
			->with('class',Class_::find($id));
	}

	public function postDelete($id){
		Class_::find($id)->delete();
		return Redirect::action('ClassController@getIndex')
			->with('success','Tíma hent!');
	}

	public function getEdit($id){
		return View::make('admin.classes.edit')
			->with('class',Class_::find($id));
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