@extends('admin.includes.layout')
@section('title')
payment
@endsection
@section('header')
Payment <tag color="success">{{$payment->type}}</tag>
@endsection
@section('breadcrumb')
<li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> dashboard</a></li>
<li><a href="{{ route('clients.index') }}"><i class="ion-card"></i> payments</a></li>
<li class="active">{{ $payment->id }}</li>
@endsection
@section('content')
@include('admin.trips.includes.invoice', ['trip' => $payment->trip])
<div class="row"> 
  <div class="col-md-6">
    @include('admin.clients.includes.user-widget', ['client' => $payment->trip->client])
  </div>
  <div class="col-md-6">
    @include('admin.drivers.includes.user-widget', ['driver' => $payment->trip->driver])
  </div>
</div>
<div class="row"> 
  <div class="col-md-6">
    @include('admin.components.googlemaps-directions', ['trip' => $payment->trip])
  </div>
  <div class="col-md-6">
    @include('admin.trips.includes.details', ['trip' => $payment->trip])
  </div>
</div>
@endsection