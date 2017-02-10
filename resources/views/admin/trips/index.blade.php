@extends('admin.includes.layout')
@section('title')
Trips
@endsection
@section('header')
Trips
@endsection
@section('breadcrumb')
<li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> dashboard</a></li>
<li class="active"><i class="ion-android-walk"></i> Trips</li>
@endsection
@section('content')
<div class="row">
  <div class="col-md-6">
    <info-box text="Finished" number="{{ $countOfFinishedTrips }}" color="green" icon="ion-android-pin"></info-box>
  </div>
  <div class="col-md-6">
    <info-box text="Canceled" number="{{ $countOfCancelledTrips }}" color="red" icon="ion-android-watch"></info-box>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="box box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Monthly Recap Report</h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <div class="row">
          <div class="col-md-4">
            @include('admin.components.progress', ['name' => 'Driver rejected client', 'progress' => $progress['4'], 'total' => $progress['total']])
            @include('admin.components.progress', ['name' => 'No driver', 'progress' => $progress['5'], 'total' => $progress['total']])
            @include('admin.components.progress', ['name' => 'Driver rejected started trip', 'progress' => $progress['8'], 'total' => $progress['total']])
            @include('admin.components.progress', ['name' => 'Driver rejected on arrived status', 'progress' => $progress['14'], 'total' => $progress['total']])
          </div>
          <!-- /.col -->
          <div class="col-md-4">
            @include('admin.components.progress', ['name' => 'Client canceled requested taxi', 'progress' => $progress['10'], 'total' => $progress['total']])
            @include('admin.components.progress', ['name' => 'Client canceled onway driver', 'progress' => $progress['11'], 'total' => $progress['total']])
            @include('admin.components.progress', ['name' => 'Client canceled arrived driver', 'progress' => $progress['13'], 'total' => $progress['total']])
          </div>
          <!-- /.col -->
          <div class="col-md-4">
            @include('admin.components.progress', ['name' => 'Trip is over', 'progress' => $progress['17'], 'total' => $progress['total']])
            @include('admin.components.progress', ['name' => 'Trip ended not rated', 'progress' => $progress['9'], 'total' => $progress['total']])
            @include('admin.components.progress', ['name' => 'Driver rated not yet client', 'progress' => $progress['15'], 'total' => $progress['total']])
            @include('admin.components.progress', ['name' => 'Client rated not yet driver', 'progress' => $progress['16'], 'total' => $progress['total']])
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- ./box-body -->
    </div>
    <!-- /.box -->
  </div>
  <!-- /.col -->
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
        {!! Form::open(['action' => 'Admin\TripController@filter', 'method' => 'get', 'class' => 'form-inline']) !!}
        @include('components.bootstrap.select', ['name' => 'sortby',
        'label' => 'Sort by',
        'items' => \App\Trip::$sortable])
        @include('components.bootstrap.select', ['name' => 'orderby',
        'label' => 'Order by',
        'items' => [
        'asc'  => 'Ascending',
        'desc' => 'Descending']])
        @include('components.bootstrap.select', ['name' => 'count',
        'label' => 'Count',
        'items' => [
        15 => 15,
        30 => 30,
        'all' => 'All']])
        @include('components.bootstrap.select', ['name' => 'status',
        'label' => 'Status',
        'items' => \App\Trip::$status])
        @include('components.bootstrap.daterangepicker', ['name' => 'date_range',
        'label' => 'Date range'])
        {!! Form::close() !!}
      </div>
      <!-- /.box-body -->
    </div>
    <div class="box box-solid">
      <div class="box-header">
        <h3 class="box-title">List</h3>
        <div class="box-tools">
          {!! Form::open(['action' => 'Admin\TripController@search', 'method' => 'get']) !!}
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
        <table class="table table-striped table-hover">
          <tbody>
            <tr>
              <tr>
                <th>Driver</th>
                <th>Client</th>
                <th>Source</th>
                <th>Destination</th>
                <th>Distance</th>
                <th>Cost</th>
                <th>Duration</th>
                <th>Created at</th>
                <th>Status</th>
              </tr>
              @foreach($trips as $trip)
              <tr onclick="window.document.location='{{ action('Admin\TripController@show', ['id' => $trip->id]) }}';" style="cursor: pointer;">
                <td>{!! $trip->driver->first_name or '<tag color="default"></tag>' !!} {!! $trip->driver->last_name or '<tag color="default"></tag>' !!}</td>
                <td>{!! $trip->client->first_name or '<tag color="default"></tag>' !!} {!! $trip->client->last_name or '<tag color="default"></tag>' !!}</td>
                <td>{{ $trip->sourceName() }}</td>
                <td>{{ $trip->destinationName() }}</td>
                <td>{{ $trip->distance_text }}</td>
                <td>{!! $trip->transaction->total or '<tag color="default"></tag>' !!} {!! $trip->transaction->currency or '<tag color="default"></tag>' !!}</td>
                <td>{{ $trip->eta_text }}</td>
                <td>{{ $trip->created_at->diffForHumans() }}</td>
                <td>
                  <tag color="primary">{{ $trip->statusName() }}</tag>
                </td>
              </tr>
              @endforeach
            </tbody></table>
          </div>
          <!-- /.box-body -->
          <div class="box-footer clearfix">
            @include('admin.includes.pagination', ['resource' => $trips])
          </div>
        </div>
        <!-- /.box -->
      </div>
    </div>
    @endsection