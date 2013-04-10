<?php

class Room extends Eloquent{
	public $timestamps = false;
	public function type_(){
		return $this->belongsTo('Type','type');
	}
	public function timetable(){
		return $this->hasMany('TimeTable');
	}
}