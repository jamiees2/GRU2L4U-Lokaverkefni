@extends('main')

@section('title')
Ný stofa
@stop
@section('main')
<h2>Ný stofa</h2>
<br />
<form method="post" accept-charset="utf8" action="{{URL::action('RoomController@postNew')}}" class="form-horizontal">
  <div class="control-group">
    <label class="control-label" for="number">Númer</label>
    <div class="controls">
      <input type="text" name="number" id="number" placeholder="Númer" value="" required>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="type">Tegund</label>
    <div class="controls">
      <select name="type" id="type">
        @foreach($types as $type)
        <option value="{{$type->id}}">{{$type->description}}</option>
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