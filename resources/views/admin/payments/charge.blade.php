@extends('admin.includes.layout')
@section('title')
payment
@endsection
@section('header')
Payment
@endsection
@section('breadcrumb')
<li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> dashboard</a></li>
<li><a href="{{ route('clients.index') }}"><i class="ion-card"></i> payments</a></li>
<li class="active">{{ $payment->id }}</li>
@endsection
@section('content')
<div class="row"> 
  <div class="col-md-6">
    @include('admin.clients.includes.user-widget', ['client' => $payment->client])
  </div>
  <div class="col-md-6">
    @include('admin.payments.includes.details', ['payment' => $payment])
  </div>
</div>
@endsection