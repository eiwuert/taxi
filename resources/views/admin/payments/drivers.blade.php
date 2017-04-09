@extends('admin.includes.layout')
@section('title')
@lang('admin/general.Drivers')
@endsection
@section('header')
@lang('admin/general.Drivers')
@endsection
@section('breadcrumb')
<li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i>@lang('admin/general.dashboard') </a></li>
<li><a href="{{ route('payments.index') }}"><i class="ion-card"></i>@lang('admin/general.payments') </a></li>
<li class="active"> @lang('admin/general.drivers')</li>
@endsection
@section('content')
<div class="row">
  <div class="col-xs-12">
    <div class="box box-solid">
      <div class="box-header with-border">
        <i class="fa fa-filter"></i>
        <h3 class="box-title">@lang('admin/general.Filter')</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        {!! Form::open(['action' => 'Admin\PaymentController@drivers', 'method' => 'get', 'class' => 'form-inline']) !!}
        @include('components.bootstrap.select', ['name' => 'sortby',
        'label' => 'Sort by',
        'items' => \App\Driver::$sortable])
        @include('components.bootstrap.select', ['name' => 'orderby',
        'label' => 'Order by',
        'items' => [
        'asc'  => 'Ascending',
        'desc' => 'Descending']])
        @include('components.bootstrap.select', ['name' => 'count',
        'label' => 'Count',
        'items' => [
        15 => 15,
        30 => 30,
        'all' => 'All']])
        @include('components.bootstrap.daterangepicker', ['name' => 'date_range',
        'label' => 'Date range'])
        {!! Form::close() !!}
      </div>
      <div class="box-footer">
        @include('admin.components.filter')
      </div>
      <!-- /.box-body -->
    </div>
    <div class="box box-solid">
      <div class="box-header">
        <h3 class="box-title">@lang('admin/general.List')</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body table-responsive no-padding">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>@lang('admin/general.First name')</th>
              <th>@lang('admin/general.Last name')</th>
              <th>@lang('admin/general.Income')</th>
              <th>@lang('admin/general.Trips')</th>
            </tr>
          </thead>
          <tbody>
            @foreach($drivers as $driver)
            <tr onclick="window.document.location='{{ route('payments.drivers.trips', ['driver' => $driver->id, 'filters' => http_build_query(Request::all())]) }}'" style="cursor: pointer;">
              <td>{!! $driver->first_name or '<tag color="default"></tag>' !!}</td>
              <td>{!! $driver->first_name or '<tag color="default"></tag>' !!}</td>
              <td>{{ $driver->income(Request::input('date_range')) }}</td>
              <td>{{ $driver->trips()->range(Request::input('date_range'))->count() }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <!-- /.box-body -->
      <div class="box-footer clearfix">
        @include('admin.includes.pagination', ['resource' => $drivers])
      </div>
    </div>
    <!-- /.box -->
  </div>
</div>
@endsection
@push('js')
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<script type="text/javascript">
$(function () {
    var start = moment().subtract(29, 'days');
    var end = moment();

    function cb(start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }

    $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);

    cb(start, end);
});
</script>
@endpush