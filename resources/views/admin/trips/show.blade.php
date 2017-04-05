@extends('admin.includes.layout')
@section('title')
Trip
@endsection
@section('header')
Trip @if($trip->status_id != 18) <a href="{{ route('trips.hardCancel', ['trip' => $trip]) }}"><btn-danger add-class='btn-xs' text='hard canel' icon='trash' type='button'></btn-danger></a> @endif
@endsection
@section('breadcrumb')
<li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> dashboard</a></li>
<li><a href="{{ route('trips.index') }}"><i class="ion-android-navigate"></i> Trip</a></li>
<li class="active">{{ $trip->id }}</li>
@endsection
@section('content')
<div class="row">
    <div class="col-md-6">
        @include('admin.drivers.includes.user-widget', ['driver' => $trip->driver])
    </div>
    <!-- /.col -->
    <div  class=@if(!is_null($trip->driver))"col-md-6"@else"col-md-12"@endif>
        @include('admin.clients.includes.user-widget', ['client' => $trip->client])
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
<div class="row">
    <div class=@if(!is_null($trip->driver))"col-md-6"@else"col-md-12"@endif>
        @include('admin.components.googlemaps-directions', ['trip' => $trip, 'height' => '357px'])
    </div>
    <!-- /.col -->
    <div class="col-md-6">
        @include('admin.trips.includes.invoice', ['trip' => $trip])
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-md-6">
        @include('admin.trips.includes.rate', ['trip' => $trip])
    </div>
    <!-- /.col -->
    <div class="col-md-6">
        @include('admin.trips.includes.details', ['trip' => $trip])
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
@endsection