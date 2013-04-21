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

Route::post('/login',function(){
	$user = array(
		'username' => Input::get('username'),
		'password' => Input::get('password'),
	);
	if (Auth::attempt($user, Input::has('remember'))) {
        return Redirect::to('/')
            ->with('success', 'Þú ert skráður inn');
    }
    else
    	return Redirect::back()
    		->with('error','Innskráning mistókst, vinsamlegast reyndu aftur');
})->before('guest');

Route::get('/logout',function(){
	Auth::logout();
	return Redirect::to('/')
		->with('success','Útskráning tókst');
})->before('auth');



Route::controller('rooms','RoomController');
Route::controller('classes','ClassController');
Route::controller('timetable','TimetableController');