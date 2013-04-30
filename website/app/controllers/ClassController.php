<?php

class ClassController extends BaseController {
	/**
	 * Constructs the controller instance, mainly here for preventing unauthorized access
	 *
	 */
	public function __construct(){
		//Prevent users not logged in from accessing editing views
		$this->beforeFilter('auth', array('only' =>
                            array('getNew', 'postNew',
                            	'getDelete','postDelete',
                            	'getEdit','postEdit')));
	}

	/**
	 * Returns a table view with all the classes
	 */
	public function getIndex(){
		//Add footable
		Asset::container('footer')->add('footable','js/footable-0.1.js');
		Asset::container('footer')->add('footable-sortable','js/footable.sortable.js');
		Asset::container('footer')->add('footable-filter','js/footable.filter.js');
		Asset::container('head')->add('footable','css/footable-0.1.css');
		Asset::container('head')->add('footable-sortable','css/footable.sortable-0.1.css');
		return View::make('admin.classes')
			->with('classes',Class_::all());
	}

	/**
	 * Returns a view for creating a new class
	 */
	public function getNew(){
		return View::make('admin.classes.new');
	}

	/**
	 * Creates the new Class
	 */
	public function postNew(){
		$room = new Class_;
		$room->name = HTML::entities(Input::get('name'));
		$room->description = HTML::entities(Input::get('description'));
		if($room->save())
			return Redirect::action('ClassController@getIndex')
				->with('success','Tími skráður!');
		else 
			return Redirect::back()
				->with('error','Gekk ekki að nýskrá tíma!');

	}

	/**
	 * Returns a view for deleting the class
	 */
	public function getDelete($id){
		return View::make('admin.classes.delete')
			->with('class',Class_::find($id));
	}

	/**
	 * Deletes the class and then redirects to the index
	 */
	public function postDelete($id){
		Class_::find($id)->delete();
		return Redirect::action('ClassController@getIndex')
			->with('success','Tíma hent!');
	}

	/**
	 * Returns a view for editing
	 */
	public function getEdit($id){
		return View::make('admin.classes.edit')
			->with('class',Class_::find($id));
	}

	/**
	 * Edits the class and then redirects back
	 */
	public function postEdit($id){
		$room = Class_::find($id);
		//Escape HTML in the input (prevent XSS)
		$room->name = HTML::entities(Input::get('name'));
		$room->description = HTML::entities(Input::get('description'));
		if($room->save())
			return Redirect::action('ClassController@getIndex')
				->with('success','Tími vistaður!');
		else 
			return Redirect::back()
				->with('error','Gekk ekki að vista tíma!');
	}
}