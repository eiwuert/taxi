@extends('admin.includes.layout')
@section('title')
drivers
@endsection
@section('header')
Drivers
@endsection
@section('breadcrumb')
<li><a href="#"><i class="fa fa-dashboard"></i> dashboard</a></li>
<li class="active">drivers</li>
@endsection
@section('content')
<div class="row">
  <div class="col-md-3">
    @include('admin.drivers.includes.profile', ['driver' => $driver])
    @include('admin.drivers.includes.about', ['driver' => $driver])
  </div>
  <!-- /.col -->
  <div class="col-md-9">
    @include('admin.errors.form')
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#timeline" data-toggle="tab">Timeline</a></li>
        <li><a href="#info" data-toggle="tab">Info</a></li>
        <li><a href="#car" data-toggle="tab">Car</a></li>
      </ul>
      <div class="tab-content">
        <div class="active tab-pane" id="timeline">
          @include('admin.drivers.includes.timeline', ['driver' => $driver])
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="info">
          @include('admin.drivers.edit', ['driver' => $driver])
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="car">
          @include('admin.cars.edit', ['car' => $driver->car()])
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
@push('js')
<script src="{{ elixir('js/admin/jquery.inputmask.js') }}"></script>
<script type="text/javascript">
$(function () {
  $(".data-mask-plate").inputmask();
});
</script>
@endpush