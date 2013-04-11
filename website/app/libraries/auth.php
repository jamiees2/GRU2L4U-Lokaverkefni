<?php

use Illuminate\Auth\Guard;

Auth::extend('user_auth',function(){
	return new Guard(
		new UserProvider(),
		App::make('session')
	);
});

use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Auth\UserInterface;
class UserProvider extends EloquentUserProvider
{
	public function validateCredentials(UserInterface $user, array $credentials)
	{
		$plain = $credentials['password'];
		return $plain === $user->getAuthPassword();
	}
}