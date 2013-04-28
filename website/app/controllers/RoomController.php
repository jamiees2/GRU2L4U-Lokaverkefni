<?php

class RoomController extends BaseController {
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
		return View::make('admin.rooms')
			->with('rooms',Room::with('type_')->get());
	}

	public function getNew(){
		return View::make('admin.rooms.new')
			->with('types',Type::all());
	}

	public function postNew(){
		$room = new Room;
		$room->number = HTML::entities(Input::get('number'));
		$room->type = HTML::entities(Input::get('type'));
		if ($room->save())
			return Redirect::action('RoomController@getIndex')
				->with('success','Stofa skráð!');
		else
			return Redirect::back()
				->with('error','Gekk ekki að nýskrá stofu!');

	}

	public function getDelete($id){
		return View::make('admin.rooms.delete')
			->with('room',Room::find($id));
	}

	public function postDelete($id){
		Room::find($id)->delete();
		return Redirect::action('RoomController@getIndex')
			->with('success','Herbergi hent!');
	}

	public function getEdit($id){
		return View::make('admin.rooms.edit')
			->with('room',Room::find($id))
			->with('types',Type::all());
	}

	public function postEdit($id){
		$room = Room::find($id);
		$room->number = HTML::entities(Input::get('number'));
		$room->type = HTML::entities(Input::get('type'));
		if ($room->save())
			return Redirect::action('RoomController@getIndex')
				->with('success','Herbergi vistað!');
		else
			return Redirect::back()
				->with('error','Gekk ekki að nýskrá stofu!');
	}
}