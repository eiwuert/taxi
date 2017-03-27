@extends('admin.includes.layout')
@section('title')
Track
@endsection
@section('header')
Track
@endsection
@section('breadcrumb')
<li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> dashboard</a></li>
<li class="active"><i class="ion-map"></i> Track</li>
@endsection
@section('content')
<div class="row">
  <div class="col-xs-12">
  @include('admin.components.googlemaps-marker')
  </div>
</div>
@endsection
