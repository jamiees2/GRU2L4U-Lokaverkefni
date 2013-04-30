@extends('main')

@section('title')
Skrá inn
@stop
@section('main')
<h2>Ný stofa</h2>
<br />
<form method="post" accept-charset="utf8" action="{{URL::action('ClassController@postNew')}}" class="form-horizontal">
  <div class="control-group">
    <label class="control-label" for="name">Nafn</label>
    <div class="controls">
      <input type="text" name="name" id="name" placeholder="Nafn" value="" required>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="description">Lýsing</label>
    <div class="controls">
      <textarea name="description" id="description" rows="6" cols="10"></textarea>
    </div>
  </div>
  <div class="control-group">
    <div class="controls">
      <button type="submit" class="btn btn-success">Vista</button>
    </div>
  </div>
</form>

@stop