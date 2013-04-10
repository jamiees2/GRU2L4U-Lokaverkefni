<?php

class Type extends Eloquent{
	public $timestamps = false;
	public function rooms(){
		return $this->hasMany('Room','type');
	}
}