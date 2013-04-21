@extends('main')

@section('title')
Stofur
@stop
@section('main')
<h2>Stofur</h2>
<br />
<div class="row-fluid">
    <div class="span12">
      <table class="table footable">
        <thead>
          <th data-class="expand">Tafla</th>
          <th>Nafn</th>
          <th data-hide="phone,tablet">Lýsing</th>
          @if(Auth::check())
          <th data-hide="phone,tablet">Breyta</th>
          <th data-hide="phone,tablet">Henda</th>
          @endif
      </thead>
      @foreach($rooms as $room)
      <tr>
          <td><a class="btn btn-small btn-primary" href="{{URL::action('TimetableController@getByroom',array($room->id))}}">Tafla stofu</a></td>
          <td>{{$room->number}}</td>
          <td>{{$room->type_->description}}</td>

          @if(Auth::check())
          <td>
            <a class="btn btn-small btn-primary" href="{{URL::action('RoomController@getEdit',array($room->id))}}">Edit</a>
            
          </td>
          <td>
            <a class="btn btn-small btn-danger" href="{{URL::action('RoomController@getDelete',array($room->id))}}">Delete</a>
          </td>
          @endif
      </tr>
      @endforeach
    </table>
    @if(Auth::check())
    <a class="btn btn-primary" href="{{URL::action('RoomController@getNew')}}">Ný stofa</a>
    @endif
  </div>
</div>
@stop