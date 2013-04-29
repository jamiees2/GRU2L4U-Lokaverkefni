<?php

class DayPeriod extends Eloquent{
	protected $table = 'days_periods';
	public function timetable(){
		return $this->hasMany('Timetable');
	}
	public function day(){
		return $this->belongsTo('Day');
	}
	public function period(){
		return $this->belongsTo('Period');
	}
	
}