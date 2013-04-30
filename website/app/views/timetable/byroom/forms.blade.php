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
          <label class="control-label" for="edit-select-class">Áfangi</label>
          <div class="controls">
            <select id="edit-select-class" name="class">
              @foreach($classes as $c)
              <option value="{{$c->id}}">{{$c->name}}</option>
              @endforeach
            </select>
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
          <label class="control-label" for="new-select-class">Áfangi</label>
          <div class="controls">
            <select id="new-select-class" name="class">
              @foreach($classes as $c)
              <option value="{{$c->id}}">{{$c->name}}</option>
              @endforeach
            </select>
          </div>
        </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn" data-dismiss="modal" aria-hidden="true">Loka</button>
      <button type="submit" class="btn btn-primary" id="new-save">Skrá áfanga</button>
    </div>
    </form>
  </div>
</div>