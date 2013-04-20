@extends('main')

@section('title')
Innskráning
@stop
@section('main')
<div class="container">
  <form class="form-signin" method="POST" action="/login">
    <h2 class="form-signin-heading">Innskráning</h2>
    <input type="text" name="username" class="input-block-level" placeholder="Notandanafn">
    <input type="password" name="password" class="input-block-level" placeholder="Lykilorð">
    <label class="checkbox">
      <input type="checkbox" value="remember-me" name="remember"> Muna eftir mér
    </label>
    <button class="btn btn-large btn-primary" type="submit">Skrá inn</button>
  </form>

</div>
@stop