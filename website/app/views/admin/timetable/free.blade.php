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
                <button class="btn btn-primary modal-btn" data-toggle="modal" data-target="{{URL::action('TimetableController@getFreeview',array($item->id))}}">
                  Lausar Stofur
                </button>
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

</div>
<script>
$(document).ready(function() {
  
  // Support for AJAX loaded modal window.
  // Focuses on first input textbox after it loads the window.
  $('.modal-btn').click(function(e) {
    e.preventDefault();
    $('#table').html('<div class="progress progress-striped active"><div class="bar" id="ajax-bar" style="width: 100%;"></div></div>');
    $('#free-rooms').modal('show');
    var url = $(this).attr('data-target');
    $.ajax({
      url: url,
      success: function(data){
        $('#table').html(data);
      }
    });
  });
  
});
</script>
@include('admin.timetable.javascript')
@stop