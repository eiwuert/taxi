@extends('admin.includes.layout')
@section('title')
@lang('admin/general.Track')
@endsection
@section('header')
@lang('admin/general.Track')
@endsection
@section('breadcrumb')
<li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i>@lang('admin/general.dashboard') </a></li>
<li class="active"><i class="ion-map"></i> @lang('admin/general.Track')</li>
@endsection
@section('content')
<div class="row">
  <div class="col-xs-12">
  @include('admin.components.googlemaps-marker')
  </div>
</div>
@endsection
