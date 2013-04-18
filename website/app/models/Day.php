<?php

class Day extends Eloquent{
	protected $table = 'days';
	public function timetable(){
		return $this->hasMany('DayPeriod');
	}
}