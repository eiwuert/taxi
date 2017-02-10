@extends('admin.includes.layout')
@section('title')
drivers
@endsection
@section('header')
Drivers
@endsection
@section('breadcrumb')
<li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> dashboard</a></li>
<li class="active"><i class="ion-model-s"></i> drivers</li>
@endsection
@section('content')
<div class="row">
  <div class="col-md-3">
    <a href="{{ route('drivers.filter') . '?status=online' }}">
      <info-box text="Online" number="{{ $countOfOnlineDrivers }}" color="green" icon="ion-record"></info-box>
    </a>
  </div>
  <div class="col-md-3">
    <a href="{{ route('drivers.filter') . '?status=onway' }}">
      <info-box text="On way" number="{{ $countOfOnWayDrivers }}" color="blue" icon="ion-record"></info-box>
    </a>
  </div>
  <div class="col-md-3">
    <a href="{{ route('drivers.filter') . '?status=inapprove' }}">
      <info-box text="Inapproved" number="{{ $countOfInapproveDrivers }}" color="red" icon="ion-record"></info-box>
    </a>
  </div>
  <div class="col-md-3">
    <a href="{{ route('drivers.filter') . '?status=offline' }}">
      <info-box text="Offline" number="{{ $countOfOfflineDrivers }}" color="orange" icon="ion-record"></info-box>
    </a>
  </div>
</div>
<div class="row">
  <div class="col-xs-12">
    <div class="box box-solid">
      <div class="box-header with-border">
        <i class="fa fa-filter"></i>
        <h3 class="box-title">Filter</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        {!! Form::open(['action' => 'Admin\DriverController@filter', 'method' => 'get', 'class' => 'form-inline']) !!}
        @include('components.bootstrap.select', ['name' => 'sortby', 
                                                'label' => 'Sort by', 
                                                'items' => \App\Driver::$sortable])
        @include('components.bootstrap.select', ['name' => 'orderby', 
                                                'label' => 'Order by', 
                                                'items' => ['asc' => 'Ascending', 'desc' => 'Descending']])
        @include('components.bootstrap.select', ['name' => 'count', 
                                                'label' => 'Count', 
                                                'items' => [15 => 15, 30 => 30, 'all' => 'All']])
        @include('components.bootstrap.daterangepicker', ['name' => 'date_range',
                                                          'label' => 'Date range'])
        {!! Form::close() !!}
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        @include('admin.components.filter')
      </div>
    </div>
    <div class="box box-solid">
      <div class="box-header">
        <h3 class="box-title">List</h3>
        <div class="box-tools">
          {!! Form::open(['action' => 'Admin\DriverController@search', 'method' => 'get']) !!}
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
        @if (!$drivers->isEmpty())
        <table class="table table-hover">
          <tbody><tr>
            <th></th>
            <th>First name</th>
            <th>Last name</th>
            <th>Status</th>
            <th>State</th>
            <th>Country</th>
            <th>Phone</th>
          </tr>
          @foreach($drivers as $driver)
          <tr onclick="window.document.location='{{ action('Admin\DriverController@show', ['id' => $driver->id]) }}';" style="cursor: pointer;">
            <td><img src="{{ $driver->getPicture() }}" alt="driver picture" class="img-circle" width="24"></td>
            <td>{!! $driver->first_name or '<tag color="default"></tag>' !!}</td>
            <td>{!! $driver->last_name or '<tag color="default"></tag>' !!}</td>
            <td><tag color="{{ $driver->state()->color }}">{{ $driver->state()->name }}</tag></td>
            <td>{{ $driver->state }}</td>
            <td>{{ $driver->country }}</td>
            <td>{{ $driver->phoneNumber() }}</td>
          </tr>
          @endforeach
          </tbody>
        </table>
        @else
        @include('admin.components.empty')
        @endif
      </div>
      <!-- /.box-body -->
      <div class="box-footer clearfix">
      @include('admin.includes.pagination', ['resource' => $drivers])
      </div>
    </div>
    <!-- /.box -->
  </div>
</div>
@endsection