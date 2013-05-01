@if(empty($rooms))
Engar stofur lausar
@else
<table class="table footable">
  <thead>
    <th>Tafla</th>
    <th>Stofa</th>
  </thead>
  <tbody>
    @foreach($rooms as $key => $room)
      <tr>
        <td><a class="btn btn-success" href="{{URL::action('TimetableController@getByroom',array($key))}}#{{$day_id}}">Tafla</a></td>
        <td>
          {{$room}}
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
@endif
