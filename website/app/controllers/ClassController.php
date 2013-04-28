<?php

class ClassController extends BaseController {
	public function __construct(){
		$this->beforeFilter('auth', array('only' =>
                            array('gettNew', 'postNew',
                            	'getDelete','postDelete',
                            	'getEdit','postEdit')));
	}
	public function getIndex(){
		Asset::container('footer')->add('footable','js/footable-0.1.js');
		Asset::container('footer')->add('footable-sortable','js/footable.sortable.js');
		Asset::container('footer')->add('footable-filter','js/footable.filter.js');
		Asset::container('head')->add('footable','css/footable-0.1.css');
		Asset::container('head')->add('footable-sortable','css/footable.sortable-0.1.css');
		return View::make('admin.classes')
			->with('classes',Class_::all());
	}

	public function getNew(){
		return View::make('admin.classes.new');
	}

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