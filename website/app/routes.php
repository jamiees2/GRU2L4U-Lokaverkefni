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

//The site root is the free rooms
Route::get('/','TimetableController@getFree');

//Login form
Route::get('/login', function()
{
	return View::make('login');
});

//Logs the user in
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

//Logs the user out
Route::get('/logout',function(){
	Auth::logout();
	return Redirect::to('/')
		->with('success','Útskráning tókst');
})->before('auth');

//Returns download location for the C# program
Route::get('/download',function(){
	return Response::download('../public/files/setup.zip', 'setup.zip',array('Content-type' => 'application/octet-stream'));
});

//All the controllers (see folder controllers/)
Route::controller('rooms','RoomController');
Route::controller('classes','ClassController');
Route::controller('timetable','TimetableController');
Route::controller('users','UserController');

//Error handling
//404
App::missing(function($exception)
{
    return Response::view('errors.missing', array(), 404);
});

//Fatal errors (500)
App::fatal(function($exception)
{
    return Response::view('errors.fatal', array(), 500);
});

//Most other errors (500)
App::error(function(ErrorException $exception)
{
    return Response::view('errors.fatal', array(), 500);
});