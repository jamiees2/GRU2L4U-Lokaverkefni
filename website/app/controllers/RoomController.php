<?php

class RoomController extends BaseController {
	public function getIndex(){
		Asset::container('footer')->add('footable','js/footable-0.1.js');
		Asset::container('head')->add('footable','css/footable-0.1.css');
		return View::make('admin.rooms')
			->with('rooms',Room::with('type_')->get());
	}

	public function getNew(){
		return View::make('admin.rooms.new')
			->with('types',Type::all());
	}

	public function postNew(){
		$room = new Room;
		$room->number = Input::get('number');
		$room->type = Input::get('type');
		$room->save();

		return Redirect::action('RoomController@getIndex')
			->with('success','Herbergi skráð!');

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
		$room->number = Input::get('number');
		$room->type = Input::get('type');
		$room->save();
		return Redirect::action('RoomController@getIndex')
			->with('success','Herbergi vistað!');
	}
}