@extends('main')

@section('title')
Eyða stofu
@stop
@section('main')
<h2>Eyða stofu</h2>
<br />
<form method="post" accept-charset="utf8" action="{{URL::action('RoomController@postDelete',array($room->id))}}" class="form-horizontal">
  <div class="span2">
    <button type="submit" class="btn btn-danger">Eyða</button>
  </div>
  <div class="span2 delete-btn">
    <a class="btn btn-primary" href="{{URL::action('RoomController@getIndex')}}">Hætta við</a>
  </div>
</form>
@stop