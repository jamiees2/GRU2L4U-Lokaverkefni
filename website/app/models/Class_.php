<?php

class Class_ extends Eloquent{
	public $timestamps = false;
	protected $table = 'classes';
	public function timetable(){
		return $this->hasMany('TimeTable','class_id');
	}
}

