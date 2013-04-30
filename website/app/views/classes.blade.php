@extends('main')

@section('title')
Áfangar
@stop
@section('main')
<h2>Áfangar</h2>
<br />
<div class="row-fluid">
    <div class="span12">
      <form class="form-search">
        <input id="filter" type="text" placeholder="Leit" class="input-medium search-query"/>
      </form>
      <table data-filter="#filter" class="table footable">
        <thead>
          <th data-class="expand" data-hide="phone">Tafla</th>
          <th data-sort-initial="true">Nafn</th>
          <th data-hide="phone">Lýsing</th>
          @if(Auth::check())
          <th data-hide="phone,tablet">Breyta</th>
          <th data-hide="phone,tablet">Henda</th>
          @endif
      </thead>
      <tbody>
        @foreach($classes as $class_)
        <tr>
            <td><a class="btn btn-small btn-primary" href="{{URL::action('TimetableController@getByclass',array($class_->id))}}">Tafla áfanga</a></td>
            <td>{{$class_->name}}</td>
            <td>{{$class_->description}}</td>
            @if(Auth::check())
            <td><a class="btn btn-primary" href="{{URL::action('ClassController@getEdit',array($class_->id))}}">Breyta</a></td>
            <td><a class="btn btn-danger" href="{{URL::action('ClassController@getDelete',array($class_->id))}}">Henda</a></td>
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