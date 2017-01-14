@extends('admin.includes.layout')
@section('title')
clients
@endsection
@section('header')
Clients
@endsection
@section('breadcrumb')
<li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> dashboard</a></li>
<li class="active">clients</li>
@endsection
@section('content')
<div class="row">
  <div class="col-md-6">
    <a href="{{ route('clients.filter') . '?status=unlock' }}">
      <info-box text="Unlocked" number="{{ $countOfUnockedClients }}" color="green" icon="ion-unlocked"></info-box>
    </a>
  </div>
  <div class="col-md-6">
    <a href="{{ route('clients.filter') . '?status=lock' }}">
      <info-box text="Locked" number="{{ $countOfLockedClients }}" color="red" icon="ion-locked"></info-box>
    </a>
  </div>
</div>
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">List</h3>
        <div class="box-tools">
          {!! Form::open(['action' => 'Admin\ClientController@search', 'method' => 'get']) !!}
          <div class="input-group input-group-sm" style="width: 150px;">
            <input type="text" name="q" class="form-control pull-right" placeholder="Search" value="{{ Request::get('q') }}">
            <div class="input-group-btn">
              <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
            </div>
          </div>
          {!! Form::close() !!}
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body table-responsive no-padding">
        <table class="table table-hover">
          <tbody><tr>
            <th></th>
            <th>First name</th>
            <th>Last name</th>
            <th>Country</th>
            <th>Phone</th>
            <th>State</th>
          </tr>
          @foreach($clients as $client)
          <tr onclick="window.document.location='{{ action('Admin\ClientController@show', ['id' => $client->id]) }}';" style="cursor: pointer;">
            <td>{{ HTML::image('img/' . $client->picture, 'driver picture', ['class' => 'img-circle', 'width' => '24']) }}</td>
            <td>{!! $client->first_name or '<tag color="default"></tag>' !!}</td>
            <td>{!! $client->last_name or '<tag color="default"></tag>' !!}</td>
            <td>{{ $client->country }}</td>
            <td>{{ $client->phoneNumber() }}</td>
            <td><tag color="{{ $client->state()->color }}">{!! $client->state()->name !!}</tag></td>
          </tr>
          @endforeach
        </tbody></table>
      </div>
      <!-- /.box-body -->
      <div class="box-footer clearfix">
        {{ $clients->links() }}
      </div>
    </div>
    <!-- /.box -->
  </div>
</div>
@endsection