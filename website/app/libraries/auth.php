<?php
use Illuminate\Auth\UserProviderInterface;
use Illuminate\Auth\UserInterface;

class UserProvider implements UserProviderInterface {

	/**
	 * The hasher implementation.
	 *
	 * @var \Illuminate\Hashing\HasherInterface
	 */
	protected $hasher;

	/**
	 * The Eloquent user model.
	 *
	 * @var string
	 */
	protected $model;

	/**
	 * Create a new database user provider.
	 *
	 * @param  \Illuminate\Hashing\HasherInterface  $hasher
	 * @param  string  $model
	 * @return void
	 */
	public function __construct()
	{
		$this->model = 'User';
	}

	/**
	 * Retrieve a user by their unique identifier.
	 *
	 * @param  mixed  $identifier
	 * @return \Illuminate\Auth\UserInterface|null
	 */
	public function retrieveByID($identifier)
	{
		return $this->createModel()->newQuery()->find($identifier);
	}

	/**
	 * Retrieve a user by the given credentials.
	 *
	 * @param  array  $credentials
	 * @return \Illuminate\Auth\UserInterface|null
	 */
	public function retrieveByCredentials(array $credentials)
	{
		// First we will add each credential element to the query as a where clause.
		// Then we can execute the query and, if we found a user, return it in a
		// Eloquent User "model" that will be utilized by the Guard instances.
		$query = $this->createModel()->newQuery();

		foreach (array_except($credentials,array('password')) as $key => $value)
		{
			$query->where($key, $value);
		}

		return $query->first();
	}

	/**
	 * Validate a user against the given credentials.
	 *
	 * @param  \Illuminate\Auth\UserInterface  $user
	 * @param  array  $credentials
	 * @return bool
	 */
	public function validateCredentials(UserInterface $user, array $credentials)
	{
		$plain = $credentials['password'];

		return $plain == $user->getAuthPassword();
	}

	/**
	 * Create a new instance of the model.
	 *
	 * @return \Illuminate\Database\Eloquent\Model
	 */
	public function createModel()
	{
		$class = '\\'.ltrim($this->model, '\\');

		return new $class;
	}

}