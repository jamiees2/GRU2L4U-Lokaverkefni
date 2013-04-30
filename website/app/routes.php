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
Route::get('/','TimetableController@getFree');

Route::get('/login', function()
{
	return View::make('login');
});

Route::post('/login',array('as' => 'login',function(){
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
}))->before('guest');

Route::get('/logout',function(){
	Auth::logout();
	return Redirect::to('/')
		->with('success','Útskráning tókst');
})->before('auth');

Route::get('/download',function(){
	return Response::download('../public/files/setup.zip', 'setup.zip',array('Content-type' => 'application/octet-stream'));
});



Route::controller('rooms','RoomController');
Route::controller('classes','ClassController');
Route::controller('timetable','TimetableController');
Route::controller('users','UserController');

App::missing(function($exception)
{
    return Response::view('errors.missing', array(), 404);
});

App::fatal(function($exception)
{
    //return Response::view('errors.fatal', array(), 500);
});

App::error(function(ErrorException $exception)
{
    //return Response::view('errors.fatal', array(), 500);
});