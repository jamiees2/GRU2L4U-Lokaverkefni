@extends('main')

@section('title')
Stundatafla fyrir {{$class->name}}
@stop
@section('main')
<h2>Stundatafla {{$class->name}}</h2>
<br />

<ul class="nav nav-pills" id="timetable">
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
            <tr>
              <td>{{$item->period->start_time}} - {{$item->period->end_time}}</td>

              @if($item->timetable)
              <td>
                {{$item->timetable->room->number}}
              </td>
              @else
              <td></td>
              @endif
              <td>
                @if($item->timetable)
                {{$item->timetable->class_->name}}
                @endif
              </td>
				      @if(Auth::check())
              <td>
                @if($item->timetable)
                <button type="button"
                  data-id="{{$item->timetable->id}}"
                  data-toggle="modal" data-target="#edit"
                  data-room="{{$item->timetable->room->id}}"
                  class="edit btn btn-primary btn-small">Breyta</button>
                @else
                <button type="button"
                  data-toggle="modal" 
                  data-target="#new"
                  data-day="{{$item->id}}"
                  class="new btn btn-primary btn-small">Skrá</button>
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
  $(function(){
    $('.footable').on('click','.edit',function(){
      var $this = $(this);
      var room_id = $this.attr('data-room');
      $('#edit-select-room').val(room_id);
      var timetable_id = $this.attr('data-id');
      $('#edit-id').val(timetable_id);
      $('#edit-delete').attr('href',"{{URL::action('TimetableController@getDelete')}}/" + timetable_id);
    });
    $('.footable').on('click','.new',function(){
      $('#new-day').val($(this).attr('data-day'));
    });
    $('#timetable a').eq({{date('N')}} - 1).tab('show');
    $('#timetable a').on('click',function (e) {
      e.preventDefault();
      $(this).tab('show');
    }).on('shown', function (e) { 
      $('.tab-pane.active table').trigger('footable_resize');
    });
  });
  </script>
@stop