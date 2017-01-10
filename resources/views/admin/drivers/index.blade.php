@extends('admin.includes.layout')
@section('title')
drivers
@endsection
@section('header')
Drivers
@endsection
@section('breadcrumb')
<li><a href="#"><i class="fa fa-dashboard"></i> dashboard</a></li>
<li class="active">drivers</li>
@endsection
@section('content')
<div class="row">
  <div class="col-md-3">
    <a href="{{ route('driverFilter') . '?status=online' }}">
      <info-box text="Online" number="{{ $countOfOnlineDrivers }}" color="green" icon="ion-record"></info-box>
    </a>
  </div>
  <div class="col-md-3">
    <a href="{{ route('driverFilter') . '?status=onway' }}">
      <info-box text="On way" number="{{ $countOfOnWayDrivers }}" color="blue" icon="ion-record"></info-box>
    </a>
  </div>
  <div class="col-md-3">
    <a href="{{ route('driverFilter') . '?status=inapprove' }}">
      <info-box text="Inapproved" number="{{ $countOfInapproveDrivers }}" color="red" icon="ion-record"></info-box>
    </a>
  </div>
  <div class="col-md-3">
    <a href="{{ route('driverFilter') . '?status=offline' }}">
      <info-box text="Offline" number="{{ $countOfOfflineDrivers }}" color="orange" icon="ion-record"></info-box>
    </a>
  </div>
</div>
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">List</h3>
        <div class="box-tools">
          <div class="input-group input-group-sm" style="width: 150px;">
            <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">
            <div class="input-group-btn">
              <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
            </div>
          </div>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body table-responsive no-padding">
        <table class="table table-hover">
          <tbody><tr>
            <th></th>
            <th>first name</th>
            <th>last name</th>
            <th>status</th>
            <th>state</th>
            <th>country</th>
            <th></th>
          </tr>
          @foreach($drivers as $driver)
          <tr>
            <td>{{ HTML::image('img/' . $driver->picture, 'driver picture', ['class' => 'img-circle', 'width' => '24']) }}</td>
            <td>{!! $driver->first_name or '<tag color="default"></tag>' !!}</td>
            <td>{!! $driver->last_name or '<tag color="default"></tag>' !!}</td>
            <td><tag color="{{ $driver->state()->color }}">{{ $driver->state()->name }}</tag></td>
            <td>{{ $driver->state }}</td>
            <td>{{ $driver->country }}</td>
            <td>
              <a href="{{ action('Admin\DriverController@show', ['id' => $driver->id]) }}">
                <button class="btn btn-default btn-xs">
                  <span class="fa fa-arrow-right fa-fw"></span>
                </button>
              </a>
            </td>
          </tr>
          @endforeach
        </tbody></table>
      </div>
      <!-- /.box-body -->
      <div class="box-footer clearfix">
        {{ $drivers->links() }}
      </div>
    </div>
    <!-- /.box -->
  </div>
</div>
@endsection