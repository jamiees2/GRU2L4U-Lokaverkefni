<?php

class Day extends Eloquent{
	protected $table = 'ref_days';
	public function timetable(){
		return $this->hasMany('TimeTable','Day_number');
	}
}