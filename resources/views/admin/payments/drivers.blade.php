@extends('admin.includes.layout')
@section('title')
Drivers
@endsection
@section('header')
Drivers
@endsection
@section('breadcrumb')
<li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> dashboard</a></li>
<li><a href="{{ route('payments.index') }}"><i class="ion-card"></i> payments</a></li>
<li class="active"> drivers</li>
@endsection
@section('content')
<div class="row">
  <div class="col-xs-12">
    <div class="box box-solid">
      <div class="box-header">
        <h3 class="box-title">List</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body table-responsive no-padding">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>First name</th>
              <th>Last name</th>
              <th>Income</th>
              <th>Trips</th>
            </tr>
          </thead>
          <tbody>
            @foreach($drivers as $driver)
            <tr>
              <td>{!! $driver->first_name or '<tag color="default"></tag>' !!}</td>
              <td>{!! $driver->first_name or '<tag color="default"></tag>' !!}</td>
              <td>{{ $driver->income() }}</td>
              <td>{{ $driver->trips()->count() }}</td>
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