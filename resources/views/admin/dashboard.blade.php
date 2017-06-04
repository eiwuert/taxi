@extends('admin.includes.layout')
@section('title')
@lang('admin/general.dashboard')
@endsection
@section('header')
@lang('admin/general.dashboard')
@endsection

@section('breadcrumb')
<li class="active"><i class="fa fa-dashboard"></i> @lang('admin/general.dashboard')</li>
@endsection


@section('content')
<div class="row">
	@if(Auth::user()->web->superadmin())
	<div class="col-md-3">
		<info-box text='@lang('admin/general.client')' number='{{ $clients }}' color='aqua' icon='ion-android-walk'></info-box>
	</div>
	<div class="col-md-3">
		<info-box text='@lang('admin/general.driver')' number='{{ $drivers }}' color='aqua' icon='ion-model-s'></info-box>
	</div>
	<div class="col-md-3">
		<info-box text='@lang('admin/general.trips')' number='{{ $trips }}' color='aqua' icon='ion-android-navigate'></info-box>
	</div>
	<div class="col-md-3">
		<info-box text='@lang('admin/general.income')' number='{{ $income }}' color='aqua' icon='ion-cash'></info-box>
	</div>
	@else
	<div class="col-md-4">
		<info-box text='@lang('admin/general.driver')' number='{{ $drivers }}' color='aqua' icon='ion-model-s'></info-box>
	</div>
	<div class="col-md-4">
		<info-box text='@lang('admin/general.trips')' number='{{ $trips }}' color='aqua' icon='ion-android-navigate'></info-box>
	</div>
	<div class="col-md-4">
		<info-box text='@lang('admin/general.income')' number='{{ $income }}' color='aqua' icon='ion-cash'></info-box>
	</div>
	@endif
</div>
<div class="row">
	<div class="col-md-6">
		@include('admin.components.googlemaps-markers', ['height' => '302px'])
	</div>
	<div class="col-md-6">
		@include('admin.charts.flot-line', ['title' => __('admin/general.trips') . ' - ' . date('F', mktime(0, 0, 0, \Carbon\Carbon::now()->month, 10)) ])
	</div>
</div>
@if (Auth::user()->web->superadmin())
<div class="row">
	<div class="col-md-6">
		@include('admin.charts.fcm')
	</div>
	<div class="col-md-6">
		@include('admin.components.clients')
	</div>
</div>
@endif
<div class="row">
	<div class="col-md-6">
		@include('admin.charts.trips')
	</div>
	<div class="col-md-6">
		@include('admin.components.drivers')
	</div>
</div>
@endsection