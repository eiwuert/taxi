@extends('admin.includes.layout')
@section('title')
@lang('admin/general.Clients')
@endsection
@section('header')
@lang('admin/general.Clients')
@endsection
@section('breadcrumb')
<li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> @lang('admin/general.dashboard')</a></li>
<li class="active"><i class="ion-android-walk"></i>@lang('admin/general.clients') </li>
@endsection
@section('content')
<div class="row">
  <div class="col-md-6">
    <a href="{{ route('clients.filter') . '?status=unlocked' }}">
      <info-box text="@lang('admin/general.Unlocked')" number="{{ $countOfUnockedClients }}" color="green" icon="ion-unlocked"></info-box>
    </a>
  </div>
  <div class="col-md-6">
    <a href="{{ route('clients.filter') . '?status=locked' }}">
      <info-box text="@lang('admin/general.locked')" number="{{ $countOfLockedClients }}" color="red" icon="ion-locked"></info-box>
    </a>
  </div>
</div>
<div class="row">
  <div class="col-xs-12">
    <div class="box box-solid">
      <div class="box-header with-border">
        <i class="fa fa-filter"></i>
        <h3 class="box-title">@lang('admin/general.Filter')</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        {!! Form::open(['action' => 'Admin\ClientController@filter', 'method' => 'get', 'class' => 'form-inline']) !!}
        @include('components.bootstrap.select', ['name' => 'sortby',
        'label' => __('admin/general.Sort by'),
        'items' => \App\Client::$sortable])
        @include('components.bootstrap.select', ['name' => 'orderby',
        'label' => __('admin/general.Order by'),
        'items' => ['asc' => __('admin/general.Ascending'), 'desc' => __('admin/general.Descending')]])
        @include('components.bootstrap.select', ['name' => 'count',
        'label' => __('admin/general.Count'),
        'items' => [15 => 15, 30 => 30, 'all' => 'All']])
        @include('components.bootstrap.daterangepicker', ['name' => 'date_range',
        'label' => __('admin/general.Date range')])
        @include('admin.components.export')
        {!! Form::close() !!}
        <!-- /.box-body -->
      </div>
      <div class="box-footer">
        @include('admin.components.filter')
      </div>
    </div>
    <div class="box box-solid">
      <div class="box-header">
        <h3 class="box-title">@lang('admin/general.List')</h3>
        <div class="box-tools">
          {!! Form::open(['action' => 'Admin\ClientController@search', 'method' => 'get']) !!}
          <div class="input-group input-group-sm" style="width: 150px;">
            <input type="text" name="q" class="form-control pull-right" placeholder="@lang('admin/general.Search')" value="{{ Request::get('q') }}">
            <div class="input-group-btn">
              <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
            </div>
          </div>
          {!! Form::close() !!}
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body table-responsive no-padding">
        @if(!$clients->isEmpty())
        <table class="table table-striped table-hover">
          <tbody>
            <tr>
              <tr>
                <th></th>
                <th>@lang('admin/general.First name')</th>
                <th>@lang('admin/general.Last name')</th>
                <th>@lang('admin/general.Country')</th>
                <th>@lang('admin/general.Phone')</th>
                <th>@lang('admin/general.State')</th>
              </tr>
              @foreach($clients as $client)
              <tr onclick="window.document.location='{{ action('Admin\ClientController@show', ['id' => $client->id]) }}';" style="cursor: pointer;">
                <td><img src="{{ $client->getPicture() }}" alt="driver picture" class="img-circle" width="24"></td>
                <td>{!! $client->first_name or '<tag color="default"></tag>' !!}</td>
                <td>{!! $client->last_name or '<tag color="default"></tag>' !!}</td>
                <td>{{ $client->country }}</td>
                <td>{{ $client->phoneNumber() }}</td>
                <td>{{ $client->stateName() }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
          @else
          @include('admin.components.empty')
          @endif
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
          @include('admin.includes.pagination', ['resource' => $clients])
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