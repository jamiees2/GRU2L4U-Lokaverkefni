
<table class="table footable">
  <thead>
    <th>Tafla</th>
    <th>Stofa</th>
  </thead>
  <tbody>
    @foreach($rooms as $room)
      <tr>
        <td><a class="btn btn-success" href="{{URL::action('TimetableController@getByroom',array($room['id']))}}#{{$day_id}}">Tafla</a></td>
        <td>
          {{$room['number']}}
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
