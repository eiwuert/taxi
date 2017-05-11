@extends('admin.includes.layout')
@section('title')
@lang('admin/general.Fare')
@endsection
@section('header')
<a href="{{ route('fares.create') }}">
    <button class="btn btn-primary btn-xs">
    @lang('admin/general.New car fare')
    </button>
</a> 
@lang('admin/general.Fare')
@endsection
@section('breadcrumb')
<li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> @lang('admin/general.dashboard')</a></li>
<li class="active"><i class="ion-calculator"></i> @lang('admin/general.Fare') </li>
@endsection
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-solid">
            <div class="box-header">
                <h3 class="box-title">@lang('admin/general.List')</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                @if(!$fares->isEmpty())
                <table class="table table-striped table-hover">
                    <tbody>
                        <tr>
                            <th></th>
                            <th>@lang('admin/general.Zone')</th>
                        </tr>
                        @foreach($fares as $fare)
                        <tr onclick="window.document.location='{{ action('Admin\FareController@edit', ['fare' => $fare]) }}';" style="cursor: pointer;">
                            <td># {{ $fare->id }}</td>
                            <td>{{ $fare->zone->name }}</td>
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
                @include('admin.includes.pagination', ['resource' => $fares])
            </div>
        </div>
        <!-- /.box -->
    </div>
</div>
@endsection