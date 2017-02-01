@extends('admin.includes.layout')
@section('title')
clients
@endsection
@section('header')
Client
@endsection
@section('breadcrumb')
<li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> dashboard</a></li>
<li><a href="{{ route('clients.index') }}"><i class="ion-android-walk"></i> clients</a></li>
<li class="active">{{ $client->first_name }} {{ $client->last_name }}</li>
@endsection
@section('content')
<div class="row">
  <div class="col-md-3">
    @include('admin.clients.includes.profile', ['client' => $client])
    @include('admin.clients.includes.about', ['client' => $client])
  </div>
  <!-- /.col -->
  <div class="col-md-9">
    @include('admin.errors.form')
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#timeline" data-toggle="tab">Timeline</a></li>
        <li><a href="#info" data-toggle="tab">Info</a></li>
      </ul>
      <div class="tab-content">
        <div class="active tab-pane" id="timeline">
          @include('admin.clients.includes.timeline', ['client' => $client])
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="info">
          @include('admin.clients.edit', ['client' => $client])
        </div>
        <!-- /.tab-pane -->
      </div>
      <!-- /.tab-content -->
    </div>
    <!-- /.nav-tabs-custom -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->
@endsection