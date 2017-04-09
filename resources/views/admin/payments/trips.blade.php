@extends('admin.includes.layout')
@section('title')
@lang('admin/general.payments')
@endsection
@section('header')
@lang('admin/general.payments') {{ $driver->first_name }} {{ $driver->last_name }}
@endsection
@section('breadcrumb')
<li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> @lang('admin/general.dashboard')</a></li>
<li><i class="ion-card"></i>@lang('admin/general.payment')</li>
<li><i class="ion-model-s"></i> @lang('admin/general.drivers')</li>
<li><a href="{{ route('drivers.show', ['driver' => $driver]) }}">{{ $driver->first_name }} {{ $driver->last_name }}</a></li>
<li class="active"><i class="ion-android-navigate"></i>@lang('admin/general.trips')</li>
@endsection
@section('content')
<div class="row">
  <div class="col-xs-12">
    <div class="box box-solid">
      <div class="box-header with-border">
        <i class="fa fa-filter"></i>
        <h3 class="box-title">Filter</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <form action="{{ route('payments.drivers.trips.filter', ['driver' => $driver]) }}"
            method="get"
            class="form-inline"> 
        <input type="hidden" type="text" value="{{ csrf_token() }}" />
        @include('components.bootstrap.select', ['name' => 'count',
        'label' => 'Count',
        'items' => [
        15 => 15,
        30 => 30,
        'all' => 'All']])
        @include('components.bootstrap.daterangepicker', ['name' => 'date_range',
        'label' => 'Date range'])
        @include('admin.components.export')
        </form>
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
        @if(!$payments->isEmpty())
        <table class="table table-striped table-hover">
          <tbody>
            <tr>
              <tr>
                <th>@lang('admin/general.For')</th>
                <th>@lang('admin/general.Client')</th>
                <th>@lang('admin/general.Driver')</th>
                <th>@lang('admin/general.Amount')</th>
                <th>@lang('admin/general.Trip')</th>
                <th>@lang('admin/general.Method')</th>
                <th>@lang('admin/general.Result')</th>
                <th>@lang('admin/general.details')</th>
                <th>@lang('admin/general.Created')</th>
              </tr>
              @foreach($payments as $payment)
              <tr onclick="window.document.location='{{ route('payments.show', ['id' => $payment->id]) }}'" style="cursor: pointer;">
                <td>{{ $payment->purpose() }}</td>
                <td><a href="{{ route('clients.show', ['id' => $payment->client_id]) }}">{!! $payment->trip->client->first_name or '<tag color="default"></tag>' !!} 
                                {!! $payment->trip->client->last_name or '<tag color="default"></tag>' !!} </a></td>
                <td><a href="{{ route('drivers.show', ['id' => ($payment->trip) ? $payment->trip->driver_id : '#']) }}">{!! $payment->trip->driver->first_name or '<tag color="default"></tag>' !!} 
                                {!! $payment->trip->driver->last_name or '<tag color="default"></tag>' !!} </a></td>
                <td>{{ $payment->amount() }}</td>
                <td><a href="{{ route('trips.show', ['id' => $payment->trip_id]) }}">{!! $payment->trip_id or '<tag color="default"></tag>' !!}</a></td>
                <td>{{ $payment->type }}</td>
                <td>{!! ($payment->paid) ? '<tag color="success">ok</tag>' : '<tag color="danger">fail</tag>' !!}</td>
                <td>@if(is_array($payment->detail)) <pre>{{ print_r($payment->detail) }}</pre> @else <tag color="default"></tag> @endif</td>
                <td>{{ $payment->created_at->diffForHumans() }}</td>
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
          @include('admin.includes.pagination', ['resource' => $payments])
        </div>
      </div>
      <!-- /.box -->
    </div>
  </div>
  @endsection