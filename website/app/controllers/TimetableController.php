<?php

class TimetableController extends BaseController {
	public function getIndex(){
		//Return all the rows of the timetable
		/*
		dd(Period::with(array('timetable' => function($query){
			$query->whereRoomID(1);
		},'timetable.day','timetable.class_','timetable.room'))->get());*/
		return View::make('admin.timetable')
			->with('timetable',
				Timetable::with('room','class_','user','day','period')
				->whereRoomID(1)
				->groupBy('Day_Number')
				->orderBy('Period_Number')
				->get())
			->with('days',Day::all())
			->with('periods',Period::all());
	}

	public function getNew($day_id,$period_id){
		//Return a view to make a new time assignment
	}

	public function postNew(){
		//Create a new row in the timetable

	}

	public function getDelete($id){
		//Return a view to verify deletion
	}

	public function postDelete(){
		//Delete the entry
	}

	public function getEdit($id){
		//Return a view edit
	}

	public function postEdit($id){
		//Save timetable edit
	}
}