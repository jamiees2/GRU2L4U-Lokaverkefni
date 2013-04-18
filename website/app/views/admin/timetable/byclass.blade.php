<select id="edit-select-room">
          @foreach($rooms as $r)
          <option value="{{$r->id}}">{{$r->number}}</option>
          @endforeach
        </select>