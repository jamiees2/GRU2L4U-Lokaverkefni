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
            <select id="edit-select-room">
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
      <button type="submit" class="btn btn-primary" id="edit-save">Vista breytingar</button>
    </div>
    </form>
  </div>
  <div id="new" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="header" aria-hidden="true">
    <form id="new-form" class="form-horizontal" method="POST" action="{{URL::action('TimetableController@postNew');}}">
    <input type="hidden" value="{{$class->id}}" name="class" id="new-clas" />
    <input type="hidden" value="" name="day" id="new-day" />
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      <h3 id="header">Skrá áfanga</h3>
    </div>
    <div class="modal-body">
        <div class="control-group">
          <label class="control-label">Stofa</label>
          <div class="controls">
            <select id="edit-select-room">
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
      <button type="submit" class="btn btn-primary" id="new-save">Vista breytingar</button>
    </div>
    </form>
  </div>
</div>
<script>
  $(function () {
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