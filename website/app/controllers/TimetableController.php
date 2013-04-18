<?php

class TimetableController extends BaseController {
	public function getByroom($id){
		//Return all the rows of the timetable by room
		
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
			->with('classes',Class_::all())
			->with('rooms',Room::all());
	}

	public function getByclass($id){
		//Return all the rows of the timetable by room
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
		return View::make('admin.timetable')
			->with('groups',$groups)
			->with('class',Class_::find($id));
	}

	public function postNew(){
		//Create a new row in the timetable
		$entry = new Timetable;
		$entry->class_id = Input::get('class');
		$entry->room_id = Input::get('room');
		$entry->users_id = 1;
		$entry->day_period_id = Input::get('day');
		$entry->save();
		return Redirect::back();
	}

	public function getDelete($id){
		//Return a view to verify deletion
	}

	public function postDelete(){
		//Delete the entry
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
			$entry->save();
		}
		return Redirect::back();
	}
}