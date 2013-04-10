<?php

class Timetable extends Eloquent{
	protected $table = 'timetable';
	public function room(){
		return $this->belongsTo('Room');
	}
	public function class_(){
		return $this->belongsTo('Class_');
	}
	public function user(){
		return $this->belongsTo('User','users_id');
	}
	public function day(){
		return $this->belongsTo('Day','day_number');
	}
	public function period(){
		return $this->belongsTo('Period','period_number');
	}
	
}