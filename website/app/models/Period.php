<?php

class Period extends Eloquent{
	public $timestamps = false;
	protected $table = 'ref_periods';
	public function timetable(){
		return $this->hasMany('TimeTable','period_number');
	}
}