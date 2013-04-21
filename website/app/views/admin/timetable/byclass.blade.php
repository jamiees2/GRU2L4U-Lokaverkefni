@extends('main')

@section('title')
Herbergi
@stop
@section('main')
<h2>Áfangi {{$class->name}}</h2>
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
        <table class="table">
          <thead>
            <tr>
              <th width="10%" data-hide="phone,tablet">Tími</th>
              <th width="10%">Stofa</th>
              <th>Áfangi</th>
              @if(Auth::check())
              <th>Aðgerð</th>
              @endif
            </tr>
          </thead>
          <tbody>
            @foreach($group as $item)
            <tr>
              <td>{{$item->period->start_time}} - {{$item->period->end_time}}</td>
              <td>
                @if($item->timetable)
                {{$item->timetable->room->number}}
                @endif
              </td>
              <td>
                @if($item->timetable)
                {{$item->timetable->class_->name}}
                @endif
              </td>
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
</div>
@if(Auth::check())
  @include('admin.timetable.byclass.forms')
  @endif
<script>
  $(function () {
    $('#timetable a:first').tab('show');
  });
</script>
@stop