<?php


class TimetableController extends BaseController {

	public function __construct(){
		$this->beforeFilter('auth', array('only' =>
                            array('postNew', 'getDelete','postEdit')));
	}
	public function getByroom($id){
		//Return all the rows of the timetable by room
		Asset::container('footer')->add('footable','js/footable-0.1.js');
		Asset::container('head')->add('footable','css/footable-0.1.css');
		$data = DayPeriod::with(array(
			'day','period','timetable' => function($query) use ($id)
			{
				$query->whereRoomID($id);
			}
			,'timetable.room','timetable.class_'))
			->get();
		$groups = array();
		foreach ($data as $item) {
			if (isset($groups[$item->day->name]))
				$groups[$item->day->name][] = $item;
			else 
				$groups[$item->day->name] = array($item);
		}
		//dd($groups['Mánudagur']);
		return View::make('admin.timetable.byroom')
			->with('groups',$groups)
			->with('room',Room::find($id))
			->with('classes',Class_::orderBy('name','desc')->get())
			->with('rooms',Room::all());
	}

	public function getByclass($id){
		//Return all the rows of the timetable by room
		Asset::container('footer')->add('footable','js/footable-0.1.js');
		Asset::container('head')->add('footable','css/footable-0.1.css');
		$data = DayPeriod::with(array(
			'day','period','timetable' => function($query) use ($id){
				$query->whereClassID($id);
			}
			,'timetable.room','timetable.class_'))
			->get();
		$groups = array();
		foreach ($data as $item) {
			if (isset($groups[$item->day->name]))
				$groups[$item->day->name][] = $item;
			else
				$groups[$item->day->name] = array($item);
		}
		//dd($groups['Mánudagur']);
		return View::make('admin.timetable.byclass')
			->with('groups',$groups)
			->with('class',Class_::find($id))
			->with('classes',Class_::orderBy('name','desc')->get())
			->with('rooms',Room::all());
	}

	public function getFree(){
		Asset::container('footer')->add('footable','js/footable-0.1.js');
		Asset::container('head')->add('footable','css/footable-0.1.css');
		$data = DayPeriod::with(array(
			'day','period','timetable'))
			//->whereDayID(date('N'))
			->get();
		$groups = array();
		foreach ($data as $item) {
			if (isset($groups[$item->day->name]))
				$groups[$item->day->name][] = $item;
			else
				$groups[$item->day->name] = array($item);
		}
		return View::make('admin.timetable.free')
			->with('groups',$groups)
			->with('rooms',Room::lists('number','id'));
	}

	public function getFreeview($id){
		/*
		if (!Response::ajax())
			return Redirect::action('TimetableController@getFree');*/
		$data = Timetable::whereDayPeriodId($id)->get();
		$day_id = DayPeriod::find($id)->day_id;
		$used_rooms = array();
		$rooms = Room::all()->toArray();
		foreach ($data as $key => $value) {
			if(isset($rooms[$value->room->id]))
				unset($rooms[$value->room->id]);
		}
		return View::make('admin.timetable.free.forms')
			->with('rooms',$rooms)
			->with('day_id',$day_id);
	}

	public function postNew(){
		//Create a new row in the timetable
		$entry = new Timetable;
		$entry->class_id = Input::get('class');
		$entry->room_id = Input::get('room');
		//$entry->users_id = Auth::user()->id;
		$entry->day_period_id = Input::get('day');
		if($entry->save());
			return Redirect::back()
				->with('success','Tími skráður!')
				->with('redirect','true');
		return Redirect::back()
			->with('error','Tími ekki skráður!')
			->with('redirect','true');
	}

	public function getDelete($id){
		//Delete the action
		Timetable::find($id)->delete();
		return Redirect::back()
			->with('success','Tíma hent!')
			->with('redirect','true');
	}

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