@extends('main')

@section('title')
Tímar
@stop
@section('main')
<h2>Tímar</h2>
<br />
<div class="row-fluid">
    <div class="span12">
      <table class="table">
        <thead>
          <th>ID</th>
          <th>Name</th>
          <th>Description</th>
          <th>Edit</th>
          <th>Delete</th>
      </thead>
      @foreach($classes as $class_)
      <tr>
          <td>{{$class_->id}}</td>
          <td>{{$class_->name}}</td>
          <td>{{$class_->description}}</td>
          <td><a class="btn btn-primary" href="{{URL::action('ClassController@getEdit',array($class_->id))}}">Edit</a></td>
          <td><a class="btn btn-danger" href="{{URL::action('ClassController@getDelete',array($class_->id))}}">Delete</a></td>
      </tr>
      @endforeach
    </table>
    <a class="btn btn-primary" href="{{URL::action('ClassController@getNew')}}">Ný stofa</a>
  </div>
</div>
@stop