@extends('admin.includes.layout')
@section('title')
Maps
@endsection
@section('header')
Maps
@endsection
@section('breadcrumb')
<li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> dashboard</a></li>
<li class="active"><i class="ion-map"></i> Maps</li>
@endsection
@section('content')
<div class="row">
  <div class="col-md-4">
    <a href="{{ route(Route::currentRouteName()) . '?status=online' }}">
      <info-box text="Online" number="{{ $countOfOnlineDrivers }}" color="green" icon="ion-record"></info-box>
    </a>
  </div>
  <div class="col-md-4">
    <a href="{{ route(Route::currentRouteName()) . '?status=onway' }}">
      <info-box text="On way" number="{{ $countOfOnWayDrivers }}" color="blue" icon="ion-record"></info-box>
    </a>
  </div>
  <div class="col-md-4">
    <a href="{{ route(Route::currentRouteName()) . '?status=offline' }}">
      <info-box text="Offline" number="{{ $countOfOfflineDrivers }}" color="orange" icon="ion-record"></info-box>
    </a>
  </div>
</div>
<div class="row">
  <div class="col-xs-12">
  @include('admin.components.googlemaps-markers', ['drivers' => $drivers])
  </div>
</div>
@endsection
