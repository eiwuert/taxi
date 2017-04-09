@extends('admin.includes.layout')
@section('title')
@lang('admin/general.payment')
@endsection
@section('header')
@lang('admin/general.Payment')
@endsection
@section('breadcrumb')
<li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i>@lang('admin/general.dashboard') </a></li>
<li><a href="{{ route('clients.index') }}"><i class="ion-card"></i>@lang('admin/general.payments') </a></li>
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