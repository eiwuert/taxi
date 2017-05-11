@extends('admin.includes.layout')
@section('title')
@lang('admin/general.Calculator')
@endsection
@section('header')
@lang('admin/general.Calculator')
@endsection
@section('breadcrumb')
<li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> @lang('admin/general.dashboard')</a></li>
<li class="active"><i class="ion-calculator"></i> @lang('admin/general.Calculator') </li>
@endsection
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-solid">
            <div class="box-header">
                <h3 class="box-title">@lang('admin/general.Calculator')</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <calculator entry-text="@lang('admin/general.entry')"
                            discount-text="@lang('admin/general.discount')"
                            min-text="@lang('admin/general.min')"
                            surcharge-text="@lang('admin/general.surcharge')"
                            per-time-text="@lang('admin/general.per time')"
                            per-distance-text="@lang('admin/general.per distance')"
                            per-time-unit-text="@lang('admin/general.time unit')"
                            per-distance-unit-text="@lang('admin/general.distance unit')"
                            hour-text="@lang('admin/general.hour')"
                            minute-text="@lang('admin/general.minute')"
                            kilometer-text="@lang('admin/general.kilometer')"
                            mile-text="@lang('admin/general.mile')"
                            time-text="@lang('admin/general.time')"
                            distance-text="@lang('admin/general.distance')"
                            activate-text="@lang('admin/general.activate')"
                            ></calculator>
            </div>
        </div>
        <!-- /.box -->
    </div>
</div>
@endsection