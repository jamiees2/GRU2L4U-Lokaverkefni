<?php


class TimetableController extends BaseController {
	/**
	 * Constructs the instance
	 */
	public function __construct(){
		//Prevents unauthorized access to sensitive spots
		$this->beforeFilter('auth', array('only' =>
                            array('postNew', 'getDelete','postEdit')));
	}

	/**
	 * Helper function to group the timetable entries by days
	 */
	private function _group($data){
		$groups = array();
		foreach ($data as $item) {
			if (isset($groups[$item->day->name]))
				$groups[$item->day->name][] = $item;
			else 
				$groups[$item->day->name] = array($item);
		}
		return $groups;
	}

	/**
	 * Helper function to add all the assets required
	 */
	private function _assets(){
		//Footable
		Asset::container('footer')->add('footable','js/footable-0.1.js');
		Asset::container('head')->add('footable','css/footable-0.1.css');
		//Tabs
		Asset::container('footer')->add('tabs','js/tabs.js');
	}

	/**
	 * Returns all the rows in the timetable, given the id of the room
	 */
	public function getByroom($id){
		$this->_assets();
		
		//Næ í alla dagana og periods og JOIN-a timetable þegar það er hægt
		//Ef að herbergis id'ið í timetable er það sem var beðið um
		$data = DayPeriod::with(array(
			'day','period','timetable' => function($query) use ($id)
			{
				$query->whereRoomID($id);
			}
			,'timetable.room','timetable.class_'))
			->get();
		$groups = $this->_group($data);
		//dd($groups['Mánudagur']);
		return View::make('timetable.byroom')
			->with('groups',$groups)
			->with('room',Room::find($id))
			->with('classes',Class_::orderBy('name','desc')->get())
			->with('rooms',Room::all());
	}

	/**
	 * Returns all the rows in the timetable, given the id of the class
	 */
	public function getByclass($id){
		$this->_assets();

		//Næ í alla dagana og periods og JOIN-a timetable þegar það er hægt
		//Ef að áfanga id'ið í timetable er það sem var beðið um
		$data = DayPeriod::with(array(
			'day','period','timetable' => function($query) use ($id){
				$query->whereClassID($id);
			}
			,'timetable.room','timetable.class_'))
			->get();
		$groups = $this->_group($data);

		//views/admin/timetable/byclass
		return View::make('timetable.byclass')
			->with('groups',$groups)
			->with('class',Class_::find($id))
			->with('classes',Class_::orderBy('name','desc')->get())
			->with('rooms',Room::all());
	}

	/**
	 * Returns all the rooms that are not in the timetable
	 * Analyzes what is available
	 */
	public function getFree(){
		$this->_assets();
		Asset::container('footer')->add('free-modal','js/free.modal.js');

		//Get all the day_periods and JOIN the days and the periods on it
		$data = DayPeriod::with(array('day','period'))
			->get();
		$groups = $this->_group($data);
		//views/admin/timetable/free
		return View::make('timetable.free')
			->with('groups',$groups);
	}

	/**
	 * Returns the rooms that are free, given the id of the day_period
	 * Redirects to getFree if the request was not made with AJAX
	 */
	public function getFreeview($id){
		//If the request was not ajax, tell the user to go away
		/*if (!Request::ajax())
			return Redirect::action('TimetableController@getFree');*/
		//Get all the entries for the specific day_period id
		$data = Timetable::whereDayPeriodId($id)->get();
		//Get the day id (needed for tabbing)
		$day_id = DayPeriod::find($id)->day_id;
		//Get all the rooms
		$rooms = Room::lists('number','id');
		//Get rid of all the rooms that are used
		foreach ($data as $key => $value) {
			if(isset($rooms[$value->room_id]))
			{
				unset($rooms[$value->room_id]);
			}
		}
		//Make the view
		return View::make('timetable.free.forms')
			->with('rooms',$rooms)
			->with('day_id',$day_id);
	}

	/**
	 * Creates a new entry into the timetable
	 */
	public function postNew(){
		//Create a new row in the timetable
		$entry = new Timetable;
		$entry->class_id = Input::get('class');
		$entry->room_id = Input::get('room');
		$entry->day_period_id = Input::get('day');
		
		if($entry->save());
			return Redirect::back()
				->with('success','Tími skráður!')
				->with('redirect','true');
		return Redirect::back()
			->with('error','Tími ekki skráður!')
			->with('redirect','true');
	}

	/**
	 * Deletes an entry from the timetable
	 */
	public function getDelete($id){
		//Delete the action
		Timetable::find($id)->delete();
		return Redirect::back()
			->with('success','Tíma hent!')
			->with('redirect','true');
	}

	/**
	 * Edits the entry in the timetable
	 */
	public function postEdit(){
		//Save timetable edit
		if(Input::has('id'))
		{
			$entry = Timetable::find(Input::get('id'));
			if (Input::has('class'))
				$entry->class_id = Input::get('class');
			if (Input::has('room'))
				$entry->room_id = Input::get('room');
			if($entry->save())
				return Redirect::back()
					->with('success','Tíma breytt!')
					->with('redirect','true');
			else 
				return Redirect::back()
					->with('error','Tíma ekki breytt!')
					->with('redirect','true');
		}
		return Redirect::back()
			->with('error','Tíma ekki breytt!')
			->with('redirect','true')
;	}
}