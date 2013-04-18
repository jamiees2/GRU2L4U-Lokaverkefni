<?php

class Timetable extends Eloquent{
	protected $table = 'timetable';
	public $timestamps = false;
	public function room(){
		return $this->belongsTo('Room','room_id');
	}
	public function class_(){
		return $this->belongsTo('Class_','class_id');
	}
	public function user(){
		return $this->belongsTo('User');
	}
	public function day_period(){
		return $this->belongsTo('DayPeriod');
	}
	
}