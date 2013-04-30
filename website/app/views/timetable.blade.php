@extends('main')

@section('title')
Herbergi
@stop
@section('main')
<h2>@if(isset($room))Stofa {{$room->number}}@else{{$class->name}}@endif</h2>
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
              <th>Aðgerð</th>
            </tr>
          </thead>
          <tbody>
            @foreach($group as $item)
            <tr>
              <td>{{$item->period->start_time}} - {{$item->period->end_time}}</td>
              <td>
                @if($item->timetable)
                {{$item->timetable->room->number}}
                @elseif(isset($room))
                {{$room->number}}
                @endif
              </td>
              <td>
                @if($item->timetable)
                {{$item->timetable->class_->name}}
                @elseif(isset($class))
                {{$class->name}}
                @endif
              </td>

              <td>
                @if($item->timetable)
                <a href="{{URL::action('TimetableController@getNew')}}" class="btn btn-primary btn-small">Breyta</a>
                @else
                <a href="{{URL::action('TimetableController@getNew')}}" class="btn btn-primary btn-small">Skrá</a>
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
  @endforeach
</div>
<script>
  $(function () {
    $('#timetable a:first').tab('show');
  });
</script>
@stop