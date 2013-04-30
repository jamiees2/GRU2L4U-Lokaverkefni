<?php

class RoomController extends BaseController {
	/**
     * The basic constructor, prevents unauthenticated access
     */
	public function __construct(){
		//Prevent non-logged in users from accessing important methods
		$this->beforeFilter('auth', array('only' =>
                            array('getNew', 'postNew',
                            	'getDelete','postDelete',
                            	'getEdit','postEdit')));
	}

	/**
	 * Returns a view for all the rooms in the system
	 */
	public function getIndex(){
		//Add footable
		Asset::container('footer')->add('footable','js/footable-0.1.js');
		Asset::container('footer')->add('footable-sortable','js/footable.sortable.js');
		Asset::container('footer')->add('footable-filter','js/footable.filter.js');
		Asset::container('head')->add('footable','css/footable-0.1.css');
		Asset::container('head')->add('footable-sortable','css/footable.sortable-0.1.css');
		return View::make('rooms')
			->with('rooms',Room::with('type_')->get());
	}

	/**
	 * Returns a view for creating a new room
	 */
	public function getNew(){
		return View::make('rooms.new')
			->with('types',Type::all());
	}

	/**
	 * Creates the new room, and redirects
	 */
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

	/**
	 * Returns a view for deleting a room
	 */
	public function getDelete($id){
		return View::make('rooms.delete')
			->with('room',Room::find($id));
	}

	/**
	 * Deletes the room
	 */
	public function postDelete($id){
		Room::find($id)->delete();
		return Redirect::action('RoomController@getIndex')
			->with('success','Herbergi hent!');
	}

	/**
	 * Returns a view for editing a room
	 */
	public function getEdit($id){
		return View::make('rooms.edit')
			->with('room',Room::find($id))
			->with('types',Type::all());
	}

	/**
	 * Saves the edit of a room
	 */
	public function postEdit($id){
		$room = Room::find($id);
		//Escape the HTML in the input (Prevent XSS)
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