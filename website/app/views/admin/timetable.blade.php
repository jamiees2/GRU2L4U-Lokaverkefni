@extends('main')

@section('title')
Herbergi
@stop
@section('main')
<h2>Stofa 631</h2>
<br />

<ul class="nav nav-tabs" id="timetable">
  @foreach($days as $day)
    <li><a href="#{{$day->Day_Number}}" data-toggle="tab">{{$day->Day_Name}}</a></li>
  @endforeach
</ul>
<div class="tab-content">
  @foreach($days as $day)
  <div class="tab-pane" id="{{$day->Day_Number}}">
    <div class="row-fluid">
      <div class="span12">
        <table class="table">
          <thead>
            <tr>
              <th width="10%" data-hide="phone,tablet">Tími</th>
              <th>New</th>
            </tr>
          </thead>
          <tbody>
            @foreach($periods as $period)
            <tr>
              <td>{{$period->Period_start_time}} - {{$period->Period_End_time}}</td>
              <td>
                <a href="{{URL::action('TimetableController@getNew',array($day->Day_Number,$period->Period_Number))}}" class="btn btn-primary btn-small">New</a>
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