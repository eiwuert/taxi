@extends('admin.includes.layout')

@section('header')
Dashboard
@endsection

@section('breadcrumb')
<li class="active">Dashboard</li>
@endsection


@section('content')
<div class="row">
	<div class="col-md-3">
		<info-box text='Client' number='{{ $clients }}' color='aqua' icon='ion-model-s'></info-box>
	</div>
	<div class="col-md-3">
		<info-box text='Driver' number='{{ $drivers }}' color='aqua' icon='ion-android-walk'></info-box>
	</div>
	<div class="col-md-3">
		<info-box text='trips' number='{{ $trips }}' color='aqua' icon='ion-android-navigate'></info-box>
	</div>
	<div class="col-md-3">
		<info-box text='income' number='{{ $income  }}' color='aqua' icon='ion-cash'></info-box>
	</div>
</div>
@endsection