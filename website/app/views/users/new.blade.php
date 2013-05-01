@extends('main')

@section('title')
Nýr notandi
@stop
@section('main')
<h2>Nýr notandi</h2>
<br />
<form method="post" accept-charset="utf8" action="{{URL::action('UserController@postNew')}}" class="form-horizontal">
  <div class="control-group">
    <label class="control-label" for="email">Póstfang</label>
    <div class="controls">
      <input type="text" name="email" id="email" placeholder="Tölvupóstur" value="" pattern="[^@]+@[^@]+\.[^@]+" required />
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="username">Notandanafn</label>
    <div class="controls">
      <input type="text" name="username" id="username" placeholder="Notandanafn" value="" required>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="password">Lykilorð</label>
    <div class="controls">
      <div class="input-append">
        <input type="password" name="password" id="password" placeholder="Lykilorð" pattern=""/>
        <span class="add-on"></span>
      </div>
    </div>
  </div>
  <div class="control-group">
    <label for="password_confirm" class="control-label">Lykilorð verify</label>
    <div class="controls">
      <input type="password" name="password_confirm" id="password_confirm" placeholder="Lykilorð" pattern=".{6,}"/>
    </div>
  </div>
  <div class="control-group">
    <div class="controls">
      <button type="submit" class="btn btn-success">Vista</button>
    </div>
  </div>
</form>

@stop