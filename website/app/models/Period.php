<?php

class Period extends Eloquent{
	public $timestamps = false;
	public function timetable(){
		return $this->hasMany('DayPeriod');
	}
}