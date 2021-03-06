<div id="edit" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="header" aria-hidden="true">
    <form id="edit-form" class="form-horizontal" method="POST" action="{{URL::action('TimetableController@postEdit');}}">
    <input type="hidden" value="" name="id" id="edit-id" />
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      <h3 id="header">Breyta stofu</h3>
    </div>
    <div class="modal-body">
        <div class="control-group">
          <label class="control-label" for="edit-select-room">Stofa</label>
          <div class="controls">
            <select id="edit-select-room" name="room">
              @foreach($rooms as $r)
              <option value="{{$r->id}}">{{$r->number}}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="class">Áfangi</label>
          <div class="controls">
            {{$class->name}}
          </div>
        </div>
    </div>
    <div class="modal-footer">

      <a href="#" id="edit-delete" class="btn btn-danger pull-left">Eyða</a>
      <button type="button" class="btn" data-dismiss="modal" aria-hidden="true">Loka</button>
      <button type="submit" class="btn btn-primary" id="edit-save">Vista breytingar</button>
    </div>
    </form>
  </div>

  {{--New Form--}}
  <div id="new" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="header" aria-hidden="true">
    <form id="new-form" class="form-horizontal" method="POST" action="{{URL::action('TimetableController@postNew');}}">
    <input type="hidden" value="{{$class->id}}" name="class" id="new-class" />
    <input type="hidden" value="" name="day" id="new-day" />
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      <h3 id="header">Skrá stofu</h3>
    </div>
    <div class="modal-body">
        <div class="control-group">
          <label class="control-label" for="new-select-room">Stofa</label>
          <div class="controls">
            <select id="edit-select-room" name="room">
              @foreach($rooms as $r)
              <option value="{{$r->id}}">{{$r->number}}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="class">Áfangi</label>
          <div class="controls">
            {{$class->name}}
          </div>
        </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn" data-dismiss="modal" aria-hidden="true">Loka</button>
      <button type="submit" class="btn btn-primary" id="new-save">Skrá stofu</button>
    </div>
    </form>
  </div>
</div>