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
          <th data-hide="phone">ID</th>
          <th data-class="expand">Name</th>
          <th data-hide="phone">Description</th>
          <th data-hide="phone,tablet">Edit</th>
          <th data-hide="phone,tablet">Delete</th>
      </thead>
      <tbody>
        @foreach($classes as $class_)
        <tr>
            <td>{{$class_->id}}</td>
            <td>{{$class_->name}}</td>
            <td>{{$class_->description}}</td>
            <td><a class="btn btn-primary" href="{{URL::action('ClassController@getEdit',array($class_->id))}}">Edit</a></td>
            <td><a class="btn btn-danger" href="{{URL::action('ClassController@getDelete',array($class_->id))}}">Delete</a></td>
        </tr>
        @endforeach
      </tbody>
    </table>
    <a class="btn btn-primary" href="{{URL::action('ClassController@getNew')}}">Nýr tími</a>
  </div>
</div>
@stop