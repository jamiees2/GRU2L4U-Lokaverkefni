@extends('main')

@section('title')
Lausar Stofur
@stop
@section('main')
<h2>Lausar Stofur</h2>
<br />

<ul class="nav nav-pills" id="timetable">
  @foreach($groups as $key => $group)
    <li><a href="#{{$group[0]->day_id}}" data-toggle="tab">{{$key}}</a></li>
  @endforeach
</ul>
<div class="tab-content">
  @foreach($groups as $key => $group)
  <div class="tab-pane" id="{{$group[0]->day_id}}">
    <div class="row-fluid">
      <div class="span12">
        <table class="table footable">
          <thead>
            <tr>
              <th width="40%" data-class="expand">Tími</th>
              <th width="60%">Stofa</th>
            </tr>
          </thead>
          <tbody>
            @foreach($group as $item)
            <tr>
              <td>{{$item->period->start_time}} - {{$item->period->end_time}}</td>

              @if($item->timetable->count() == count($rooms))
              <td>
                Engar stofur lausar
              </td>
              @else
              <td>
                <button class="btn btn-primary" data-toggle="modal" data-target="#{{md5($item->id)}}">
                  Lausar Stofur
                </button>
                @include('admin.timetable.free.forms')
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
@include('admin.timetable.javascript')
@stop