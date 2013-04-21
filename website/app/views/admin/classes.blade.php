@extends('main')

@section('title')
Tímar
@stop
@section('main')
<h2>Tímar</h2>
<br />
<div class="row-fluid">
    <div class="span12">
      <table class="table footable">
        <thead>
          <th data-hide="phone">Tafla</th>
          <th data-class="expand">Name</th>
          <th data-hide="phone">Description</th>
          @if(Auth::check())
          <th data-hide="phone,tablet">Edit</th>
          <th data-hide="phone,tablet">Delete</th>
          @endif
      </thead>
      <tbody>
        @foreach($classes as $class_)
        <tr>
            <td><a class="btn btn-small btn-primary" href="{{URL::action('TimetableController@getByclass',array($class_->id))}}">Tafla stofu</a></td>
            <td>{{$class_->name}}</td>
            <td>{{$class_->description}}</td>
            @if(Auth::check())
            <td><a class="btn btn-primary" href="{{URL::action('ClassController@getEdit',array($class_->id))}}">Edit</a></td>
            <td><a class="btn btn-danger" href="{{URL::action('ClassController@getDelete',array($class_->id))}}">Delete</a></td>
            @endif
        </tr>
        @endforeach
      </tbody>
    </table>
    @if(Auth::check())
    <a class="btn btn-primary" href="{{URL::action('ClassController@getNew')}}">Nýr tími</a>
    @endif
  </div>
</div>
@stop