@extends('admin.includes.layout')
@section('title')
Payments
@endsection
@section('header')
Payments
@endsection
@section('breadcrumb')
<li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> dashboard</a></li>
<li class="active"><i class="ion-card"></i> payments</li>
@endsection
@section('content')
<div class="row">
  <div class="col-md-4">
    <a href="{{ route('payments.filter') . '?status=cash' }}">
      <info-box text="Pay cash" number="{{ $countOfCash }}" color="green" icon="ion-cash"></info-box>
    </a>
  </div>
  <div class="col-md-4">
    <a href="{{ route('payments.filter') . '?status=wallet' }}">
      <info-box text="Pay wallet" number="{{ $countOfWallet }}" color="green" icon="ion-briefcase"></info-box>
    </a>
  </div>
  <div class="col-md-4">
    <a href="{{ route('payments.filter') . '?status=charge' }}">
      <info-box text="Charge" number="{{ $countOfCharge }}" color="green" icon="ion-umbrella"></info-box>
    </a>
  </div>
</div>
<div class="row">
  <div class="col-xs-12">
    <div class="box box-solid">
      <div class="box-header">
        <h3 class="box-title">List</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body table-responsive no-padding">
        @if(!$payments->isEmpty())
        <table class="table table-striped table-hover">
          <tbody>
            <tr>
              <tr>
                <th>For</th>
                <th>Client</th>
                <th>Driver</th>
                <th>Amount</th>
                <th>Trip</th>
                <th>Method</th>
                <th>Result</th>
                <th>details</th>
                <th>Created</th>
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