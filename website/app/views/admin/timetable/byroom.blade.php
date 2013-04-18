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
            <tr data-day="{{$item->id}}">
              <td>{{$item->period->start_time}} - {{$item->period->end_time}}</td>
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
              <td>
                @if($item->timetable)
                <button data-id="{{$item->timetable->id}}" type="button"data-toggle="modal" data-target="#edit" class="edit btn btn-primary btn-small">Breyta</button>
                @else
                <button type="button"data-toggle="modal" data-target="#new" class="new btn btn-primary btn-small">Skrá</button>
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
  <div id="edit" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="header" aria-hidden="true">
    <form id="edit-form" class="form-horizontal" method="POST" action="{{URL::action('TimetableController@postEdit');}}">
    <input type="hidden" value="" name="id" id="edit-id" />
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      <h3 id="header">Breyta áfanga</h3>
    </div>
    <div class="modal-body">
        <div class="control-group">
          <label class="control-label">Stofa</label>
          <div class="controls">
            {{$room->number}}
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="class">Áfangi</label>
          <div class="controls">
            <select id="edit-select-class" name="class" id="class">
              @foreach($classes as $c)
              <option value="{{$c->id}}">{{$c->name}}</option>
              @endforeach
            </select>
          </div>
        </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn" data-dismiss="modal" aria-hidden="true">Loka</button>
      <button type="submit" class="btn btn-primary" id="edit-save">Vista breytingar</button>
    </div>
    </form>
  </div>
  <div id="new" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="header" aria-hidden="true">
    <form id="new-form" class="form-horizontal" method="POST" action="{{URL::action('TimetableController@postNew');}}">
    <input type="hidden" value="{{$room->id}}" name="room" id="new-room" />
    <input type="hidden" value="" name="day" id="new-day" />
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      <h3 id="header">Skrá áfanga</h3>
    </div>
    <div class="modal-body">
        <div class="control-group">
          <label class="control-label">Stofa</label>
          <div class="controls">
            {{$room->number}}
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="class">Áfangi</label>
          <div class="controls">
            <select id="new-select-class" name="class" id="class">
              @foreach($classes as $c)
              <option value="{{$c->id}}">{{$c->name}}</option>
              @endforeach
            </select>
          </div>
        </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn" data-dismiss="modal" aria-hidden="true">Loka</button>
      <button type="submit" class="btn btn-primary" id="new-save">Vista breytingar</button>
    </div>
    </form>
  </div>
</div>
<script>
  $(function () {
    $('#timetable a:first').tab('show');
    $('.edit').on('click',function(){
      var class_id = $(this).parent().prev().attr('data-class');
      $('#edit-select-class').val(class_id);
      $('#edit-id').val($(this).attr('data-id'));
    });
    $('.new').on('click',function(){
      $('#new-day').val($(this).parent().parent().attr('data-day'));
    });
  });
</script>
@stop