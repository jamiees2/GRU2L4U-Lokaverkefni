<?php

class UserController extends BaseController {

    /**
     * The basic constructor, prevents unauthenticated access
     */
    public function __construct(){
        $this->beforeFilter('auth');
    }

    /**
     * Returns a view for all the users
     */
    public function getIndex(){
        //Add footable
        Asset::container('footer')->add('footable','js/footable-0.1.js');
        Asset::container('footer')->add('footable-sortable','js/footable.sortable.js');
        Asset::container('footer')->add('footable-filter','js/footable.filter.js');
        Asset::container('head')->add('footable','css/footable-0.1.css');
        Asset::container('head')->add('footable-sortable','css/footable.sortable-0.1.css');
        
        return View::make('users')
            ->with('users',User::all());
    }

    /**
     * Returns a view to create a new user
     */
    public function getNew(){
        Asset::container('footer')->add('password.verify','js/password.verify.js');
        return View::make('users.new');
    }

    /**
     * Creates the new user, and then redirects the user based on what happens
     */
    public function postNew(){
        $user = new User;
        $user->email = Input::get( 'email' );
        $user->username = Input::get('username');
        $user->password = Input::get('password');
        $user->role = 1;
        if($user->save())
            return Redirect::action('UserController@getIndex')
                ->with('success','Notandi skráður!');
        return Redirect::back()
            ->with('error','Gekk ekki að skrá notanda');
    }

    /**
     * Returns the view for deleting a user
     */
    public function getDelete($id){
        return View::make('users.delete')
            ->with('user',User::find($id));
    }

    /**
     * Deletes the user and redirects to the main view
     */
    public function postDelete($id){
        User::find($id)->delete();
        return Redirect::action('UserController@getIndex')
                ->with('success','Notanda hent!');
    }

    /**
     * Returns a view to edit the user
     */
    public function getEdit($id){
        Asset::container('footer')->add('password.verify','js/password.verify.js');
        return View::make('users.edit')
            ->with('user',User::find($id));
    }

    /**
     * Saves the edit and then return a redirect to go back or to the main view
     */
    public function postEdit($id){
        $user = User::find($id);
        $user->email = Input::get( 'email' );
        $user->username = Input::get('username');
        $password = Input::get('password');
        if (!empty($password))
            $user->password = $password;
        if($user->save())
            return Redirect::action('UserController@getIndex')
                ->with('success','Notandi vistaður!');
        return Redirect::back()
            ->with('error','Gekk ekki að vista notanda');
    }
}