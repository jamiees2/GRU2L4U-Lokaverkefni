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
              <td>
                <button class="btn btn-primary modal-btn" data-href="{{URL::action('TimetableController@getFreeview',array($item->id))}}">
                  Lausar Stofur
                </button>
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

<div class="modal hide fade" id="free-rooms" tabindex="-1" role="dialog" aria-labelledby="header" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3 id="header">Lausar Stofur</h3>
  </div>
  <div class="modal-body" id="table">
    
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Loka</button>
  </div>
</div>

@include('timetable.javascript')
@stop