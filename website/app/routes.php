<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

//Rótin á síðunni
Route::get('/','RoomController@getIndex');

Route::get('/login', function()
{
	return View::make('login');
});



Route::controller('rooms','RoomController');
Route::controller('classes','ClassController');
Route::controller('timetable','TimetableController');