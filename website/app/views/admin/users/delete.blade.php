@extends('main')

@section('title')
Eyða notanda
@stop
@section('main')
<h2>Eyða notanda</h2>
<br />
<form method="post" accept-charset="utf8" action="{{URL::action('UserController@postDelete',array($user->id))}}" class="form-horizontal">
  <div class="span2">
    <button type="submit" class="btn btn-danger">Eyða</button>
  </div>
  <div class="span2 delete-btn">
    <a class="btn btn-primary" href="{{URL::action('UserController@getIndex')}}">Hætta við</a>
  </div>
</form>
@stop