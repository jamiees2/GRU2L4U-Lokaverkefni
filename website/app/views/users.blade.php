@extends('main')

@section('title')
Notendur
@stop
@section('main')
<h2>Notendur</h2>
<br />
<div class="row-fluid">
    <div class="span12">
      <form class="form-search">
        <input id="filter" type="text" placeholder="Leit" class="input-medium search-query"/>
      </form>
      <table data-filter="#filter"  class="table footable">
        <thead>
          <th data-class="expand">ID</th>
          <th data-sort-initial="true" data-type="numeric">Póstfang</th>
          <th data-hide="phone,tablet">Notandanafn</th>
          @if(Auth::check())
          <th data-hide="phone,tablet">Breyta</th>
          <th data-hide="phone,tablet">Henda</th>
          @endif
      </thead>
      @foreach($users as $user)
      <tr>
          <td>{{$user->id}}</td>
          <td>{{$user->email}}</td>
          <td>{{$user->username}}</td>
          <td>
            <a class="btn btn-small btn-primary" href="{{URL::action('UserController@getEdit',array($user->id))}}">Edit</a>
          </td>
          <td>
            <a class="btn btn-small btn-danger" href="{{URL::action('UserController@getDelete',array($user->id))}}">Delete</a>
          </td>
      </tr>
      @endforeach
    </table>
    @if(Auth::check())
    <a class="btn btn-primary" href="{{URL::action('UserController@getNew')}}">Nýr notandi</a>
    @endif
  </div>
</div>
@stop