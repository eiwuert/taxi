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
    <a href="{{ route('clients.filter') . '?status=unlocked' }}">
      <info-box text="Finished" number="{{ $countOfFinishedTrips }}" color="green" icon="ion-android-pin"></info-box>
    </a>
  </div>
  <div class="col-md-6">
    <a href="{{ route('clients.filter') . '?status=locked' }}">
      <info-box text="Canceled" number="{{ $countOfCancelledTrips }}" color="red" icon="ion-android-watch"></info-box>
    </a>
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
                  {{ $count->status_id }}
                  @include('admin.components.progress', ['name' => 'Driver rejected client', 'progress' => 12.5, 'total' => 100])
                  @include('admin.components.progress', ['name' => 'name', 'progress' => 12.5, 'total' => 100])
                  @include('admin.components.progress', ['name' => 'name', 'progress' => 12.5, 'total' => 100])
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                  @include('admin.components.progress', ['name' => 'name', 'progress' => 12.5, 'total' => 100])
                  @include('admin.components.progress', ['name' => 'name', 'progress' => 12.5, 'total' => 100])
                  @include('admin.components.progress', ['name' => 'name', 'progress' => 12.5, 'total' => 100])
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                  @include('admin.components.progress', ['name' => 'name', 'progress' => 12.5, 'total' => 100])
                  @include('admin.components.progress', ['name' => 'name', 'progress' => 12.5, 'total' => 100])
                  @include('admin.components.progress', ['name' => 'name', 'progress' => 12.5, 'total' => 100])
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- ./box-body -->
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 17%</span>
                    <h5 class="description-header">$35,210.43</h5>
                    <span class="description-text">TOTAL REVENUE</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> 0%</span>
                    <h5 class="description-header">$10,390.90</h5>
                    <span class="description-text">TOTAL COST</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 20%</span>
                    <h5 class="description-header">$24,813.53</h5>
                    <span class="description-text">TOTAL PROFIT</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block">
                    <span class="description-percentage text-red"><i class="fa fa-caret-down"></i> 18%</span>
                    <h5 class="description-header">1200</h5>
                    <span class="description-text">GOAL COMPLETIONS</span>
                  </div>
                  <!-- /.description-block -->
                </div>
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>

<div class="row">
  <div class="col-xs-12">
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
            <td>{{ $trip->transaction->total }} {{ $trip->transaction->currency }}</td>
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