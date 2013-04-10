@extends('main')

@section('title')
Skrá inn
@stop
@section('main')
<h2>Breyta herbergi</h2>
<br />
<form method="post" accept-charset="utf8" action="{{URL::action('RoomController@postEdit',array($room->id))}}" class="form-horizontal">
  <div class="control-group">
    <label class="control-label" for="name">Númer</label>
    <div class="controls">
      <input type="text" name="number" id="number" placeholder="Númer" value="{{$room->number}}" required>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="type">Tegund</label>
    <div class="controls">
      <select name="type" id="type">
        @foreach($types as $type)
        @if ($type->id == $room->type)
          <option value="{{$type->id}}" selected>{{$type->description}}</option>
        @else
          <option value="{{$type->id}}">{{$type->description}}</option>
        @endif
        @endforeach
      </select>
    </div>
  </div>
  <div class="control-group">
    <div class="controls">
      <button type="submit" class="btn btn-success">Vista</button>
    </div>
  </div>
</form>

@stop