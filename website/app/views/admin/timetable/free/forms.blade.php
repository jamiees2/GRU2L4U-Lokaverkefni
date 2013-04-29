<div id="{{md5($item->id)}}" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="header" aria-hidden="true">
  <input type="hidden" value="" name="id" id="edit-id" />
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3 id="header">Lausar Stofur</h3>
  </div>
  <div class="modal-body">
    <table class="table footable">
      <thead>
        <th>Tafla</th>
        <th>Stofa</th>
      </thead>
      <tbody>
        @foreach(array_diff(array_keys($rooms),array_map(function($a){
          return $a['room_id'];
        },$item->timetable->toArray())) as $k)
          <tr>
            <td><a class="btn btn-success" href="{{URL::action('TimetableController@getByroom',array($k))}}#{{$item->id}}">Tafla</a></td>
            <td>
              {{$rooms[$k]}}
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div class="modal-footer">

    <button type="button" class="btn" data-dismiss="modal" aria-hidden="true">Loka</button>
    <button class="btn btn-primary" id="edit-save">Vista breytingar</button>
  </div>
</div>
