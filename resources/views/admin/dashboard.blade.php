@extends('admin.includes.layout')
@section('title')
dashboard
@endsection
@section('header')
Dashboard
@endsection

@section('breadcrumb')
<li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
@endsection


@section('content')
<div class="row">
	<div class="col-md-3">
		<info-box text='Client' number='{{ $clients }}' color='aqua' icon='ion-android-walk'></info-box>
	</div>
	<div class="col-md-3">
		<info-box text='Driver' number='{{ $drivers }}' color='aqua' icon='ion-model-s'></info-box>
	</div>
	<div class="col-md-3">
		<info-box text='trips' number='{{ $trips }}' color='aqua' icon='ion-android-navigate'></info-box>
	</div>
	<div class="col-md-3">
		<info-box text='income' number='{{ $income }}' color='aqua' icon='ion-cash'></info-box>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		@include('admin.components.googlemaps-markers', ['height' => '302px'])
	</div>
	<div class="col-md-6">
		@include('admin.charts.flot-line', ['title' => 'Trips - ' . date('F', mktime(0, 0, 0, \Carbon\Carbon::now()->month, 10)) ])
	</div>
</div>
@endsection

@push('js')
<script>


</script>

@endpush