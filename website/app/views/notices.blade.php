@if(Session::has('error'))
  @if(is_array(Session::get('error')))
    @foreach(Session::get('error') as $error)
    <div class="alert alert-error">
      {{$error}}
    </div>
    @endforeach
  @else
  <div class="alert alert-error">
    {{Session::get('error')}}
  </div>
  @endif
@endif
@if(Session::has('notice'))
  @if(is_array(Session::get('notice')))
    @foreach(Session::get('notice') as $error)
    <div class="alert">
      {{$error}}
    </div>
    @endforeach
  @else
  <div class="alert">
    {{Session::get('notice')}}
  </div>
  @endif
@endif
@if(Session::has('success'))
  @if(is_array(Session::get('success')))
    @foreach(Session::get('success') as $error)
    <div class="alert alert-success">
      {{$error}}
    </div>
    @endforeach
  @else
  <div class="alert alert-success">
    {{Session::get('success')}}
  </div>
  @endif
@endif