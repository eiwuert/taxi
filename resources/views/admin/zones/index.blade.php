@extends('admin.includes.layout')
@section('title')
@lang('admin/general.Zone')
@endsection
@section('header')
<a href="{{ route('zones.create') }}">
    <button class="btn btn-primary btn-xs">
    @lang('admin/general.New car zone')
    </button>
</a> 
@lang('admin/general.Zone')
@endsection
@section('breadcrumb')
<li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> @lang('admin/general.dashboard')</a></li>
<li class="active"><i class="ion-pinpoint"></i> @lang('admin/general.Zone') </li>
@endsection
@section('content')
@include('admin.components.googlemaps-circle')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-solid">
            <div class="box-header">
                <h3 class="box-title">@lang('admin/general.List')</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                @if(!$zones->isEmpty())
                <table class="table table-striped table-hover">
                    <tbody>
                        <tr>
                            <th></th>
                            <th>@lang('admin/general.Name')</th>
                            <th>@lang('admin/general.Latitude')</th>
                            <th>@lang('admin/general.Longitude')</th>
                        </tr>
                        @foreach($zones as $zone)
                        <tr onclick="window.document.location='{{ action('Admin\ZoneController@edit', ['zone' => $zone]) }}';" style="cursor: pointer;">
                            <td># {{ $zone->id }}</td>
                            <td>{{ $zone->name }}</td>
                            <td>{{ $zone->latitude }}</td>
                            <td>{{ $zone->longitude }}</td>
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
                @include('admin.includes.pagination', ['resource' => $zones])
            </div>
        </div>
        <!-- /.box -->
    </div>
</div>
@endsection