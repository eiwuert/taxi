@extends('admin.includes.layout')
@section('title')
@lang('admin/general.Maps')
@endsection
@section('header')
@lang('admin/general.Maps')
@endsection
@section('breadcrumb')
<li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i>@lang('admin/general.dashboard') </a></li>
<li class="active"><i class="ion-map"></i>@lang('admin/general.Maps') </li>
@endsection
@section('content')
<div class="row">
  <div class="col-md-4">
    <a href="{{ route(Route::currentRouteName()) . '?status=online' }}">
      <info-box text="@lang('admin/general.Online')" number="{{ $countOfOnlineDrivers }}" color="green" icon="ion-record"></info-box>
    </a>
  </div>
  <div class="col-md-4">
    <a href="{{ route(Route::currentRouteName()) . '?status=onway' }}">
      <info-box text="@lang('admin/general.On way')" number="{{ $countOfOnWayDrivers }}" color="blue" icon="ion-record"></info-box>
    </a>
  </div>
  <div class="col-md-4">
    <a href="{{ route(Route::currentRouteName()) . '?status=offline' }}">
      <info-box text="@lang('admin/general.Offline')" number="{{ $countOfOfflineDrivers }}" color="orange" icon="ion-record"></info-box>
    </a>
  </div>
</div>
<div class="row">
  <div class="col-xs-12">
  @include('admin.components.googlemaps-markers')
  </div>
</div>
@endsection
