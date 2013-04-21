@extends('main')

@section('title')
Herbergi
@stop
@section('main')
<h2>Stofa {{$room->number}}</h2>
<br />

<ul class="nav nav-tabs" id="timetable">
  @foreach($groups as $key => $group)
    <li><a href="#{{md5($key)}}" data-toggle="tab">{{$key}}</a></li>
  @endforeach
</ul>
<div class="tab-content">
  @foreach($groups as $key => $group)
  <div class="tab-pane" id="{{md5($key)}}">
    <div class="row-fluid">
      <div class="span12">
        <table class="table footable">
          <thead>
            <tr>
              <th width="20%" data-class="expand">Tími</th>
              <th width="10%" data-hide="phone,tablet">Stofa</th>
              <th>Áfangi</th>
              @if(Auth::check())
              <th data-hide="phone,tablet">Aðgerð</th>
              @endif
            </tr>
          </thead>
          <tbody>
            @foreach($group as $item)
            <tr data-day="{{$item->id}}">
              <td>{{$item->period->start_time}}-{{$item->period->end_time}}</td>
              <td>
                {{$room->number}}
              </td>
              @if($item->timetable)
              
              <td data-class="{{$item->timetable->class_->id}}">
                {{$item->timetable->class_->name}}
              </td>
              @else
              <td></td>
              @endif

              @if(Auth::check())
              <td>
                @if($item->timetable)
                <button data-id="{{$item->timetable->id}}" type="button"data-toggle="modal" data-target="#edit" class="edit btn btn-primary btn-small">Breyta</button>
                @else
                <button type="button"data-toggle="modal" data-target="#new" class="new btn btn-primary btn-small">Skrá</button>
                @endif
              </td>
              @endif
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
  @endforeach
  @if(Auth::check())
  @include('admin.timetable.byroom.forms')
  @endif
  <script>
  $(function(){
    $('#timetable a:first').tab('show');
    $('#timetable a').click(function (e) {
      e.preventDefault();
      $(this).tab('show');
    }).on('shown', function (e) { 
      $('.tab-pane.active table').trigger('footable_resize');
    });
  });
  </script>
@stop