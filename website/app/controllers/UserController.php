<?php

class UserController extends BaseController {
    public function getIndex(){
        Asset::container('footer')->add('footable','js/footable-0.1.js');
        Asset::container('footer')->add('footable-sortable','js/footable.sortable.js');
        Asset::container('footer')->add('footable-filter','js/footable.filter.js');
        Asset::container('head')->add('footable','css/footable-0.1.css');
        Asset::container('head')->add('footable-sortable','css/footable.sortable-0.1.css');
        
        return View::make('admin.users')
            ->with('users',User::all());
    }

    public function getNew(){
        Asset::container('footer')->add('password.verify','js/password.verify.js');
        return View::make('admin.users.new');
    }

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

    public function getDelete($id){
        return View::make('admin.users.delete')
            ->with('user',User::find($id));
    }

    public function postDelete($id){
        User::find($id)->delete();
        return Redirect::action('UserController@getIndex')
                ->with('success','Notanda hent!');
    }

    public function getEdit($id){
        Asset::container('footer')->add('password.verify','js/password.verify.js');
        return View::make('admin.users.edit')
            ->with('user',User::find($id));
    }

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