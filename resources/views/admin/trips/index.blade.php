@extends('admin.includes.layout')
@section('title')
@lang('admin/general.Trips')
@endsection
@section('header')
@lang('admin/general.Trips')
@endsection
@section('breadcrumb')
<li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i>@lang('admin/general.dashboard') </a></li>
<li class="active"><i class="ion-android-walk"></i>@lang('admin/general.Trips') </li>
@endsection
@section('content')
<div class="row">
  <div class="col-md-6">
    <info-box text="@lang('admin/general.Finished')" number="{{ $countOfFinishedTrips }}" color="green" icon="ion-android-pin"></info-box>
  </div>
  <div class="col-md-6">
    <info-box text="@lang('admin/general.Canceled')" number="{{ $countOfCancelledTrips }}" color="red" icon="ion-android-watch"></info-box>
  </div>
</div>
@include('admin.trips.includes.status', ['progress' => $progress])
<div class="row">
  <div class="col-xs-12">
    <div class="box box-solid">
      <div class="box-header with-border">
        <i class="fa fa-filter"></i>
        <h3 class="box-title">@lang('admin/general.Filter')</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        {!! Form::open(['action' => 'Admin\TripController@filter', 'method' => 'get', 'class' => 'form-inline']) !!}
        @include('components.bootstrap.select', ['name' => 'sortby',
        'label' => __('admin/general.Sort by'),
        'items' => \App\Trip::$sortable])
        @include('components.bootstrap.select', ['name' => 'orderby',
        'label' => __('admin/general.Order by'),
        'items' => [
        'asc'  => __('admin/general.Ascending'),
        'desc' => __('admin/general.Descending')]])
        @include('components.bootstrap.select', ['name' => 'count',
        'label' => __('admin/general.Count'),
        'items' => [
        15 => 15,
        30 => 30,
        'all' => 'All']])
        @include('components.bootstrap.select', ['name' => 'status',
        'label' => __('admin/general.Status'),
        'items' => \App\Trip::$status])
        @include('components.bootstrap.daterangepicker', ['name' => 'date_range',
        'label' => __('admin/general.Date range')])
        @include('admin.components.export')
        {!! Form::close() !!}
      </div>
      <div class="box-footer">
        @include('admin.components.filter')
      </div>
      <!-- /.box-body -->
    </div>
    <div class="box box-solid">
      <div class="box-header">
        <h3 class="box-title">@lang('admin/general.List')</h3>
        <div class="box-tools">
          {!! Form::open(['action' => 'Admin\TripController@search', 'method' => 'get']) !!}
          <div class="input-group input-group-sm" style="width: 150px;">
            <input type="text" name="q" class="form-control pull-right" placeholder="@lang('admin/general.Search')" value="{{ Request::get('q') }}">
            <div class="input-group-btn">
              <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
            </div>
          </div>
          {!! Form::close() !!}
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body table-responsive no-padding">
        @if (!$trips->isEmpty())
        <table class="table table-striped table-hover">
          <tbody>
            <tr>
              <tr>
                <th>@lang('admin/general.Driver')</th>
                <th>@lang('admin/general.Client')</th>
                <th>@lang('admin/general.Source')</th>
                <th>@lang('admin/general.Destination')</th>
                <th>@lang('admin/general.Distance')</th>
                <th>@lang('admin/general.Cost')</th>
                <th>@lang('admin/general.Duration')</th>
                <th>@lang('admin/general.Created at')</th>
                <th>@lang('admin/general.Status')</th>
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
            </tbody>
          </table>
          @else
          @include('admin.components.empty')
          @endif
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