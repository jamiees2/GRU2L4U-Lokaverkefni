@extends('main')

@section('title')
Herbergi
@stop
@section('main')
<h2>Herbergi</h2>
<br />
<div class="row-fluid">
    <div class="span12">
      <table class="table">
        <thead>
          <th>ID</th>
          <th>Name</th>
          <th>Description</th>
          <th>Edit</th>
          <th>Delete</th>
      </thead>
      @foreach($rooms as $room)
      <tr>
          <td>{{$room->id}}</td>
          <td>{{$room->number}}</td>
          <td>{{$room->type_->description}}</td>
          <td><a class="btn btn-primary" href="{{URL::action('RoomController@getEdit',array($room->id))}}">Edit</a></td>
          <td><a class="btn btn-danger" href="{{URL::action('RoomController@getDelete',array($room->id))}}">Delete</a></td>
      </tr>
      @endforeach
    </table>
    <a class="btn btn-primary" href="{{URL::action('RoomController@getNew')}}">Ný stofa</a>
  </div>
</div>
@stop