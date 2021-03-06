@extends('admin.includes.layout')
@section('title')
@lang('admin/general.Zone')
@endsection
@section('header')
@lang('admin/general.Zone')
@endsection
@section('breadcrumb')
<li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> @lang('admin/general.dashboard')</a></li>
<li class="active"><i class="ion-pinpoint"></i>@lang('admin/general.Zone') </li>
@endsection
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-solid">
            <div class="box-header">
                <h3 class="box-title">@lang('admin/general.List')</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                {!! Form::open(['method' => 'POST', 'action' => ['Admin\ZoneController@store'], 'class' => 'form-horizontal']) !!}
                <div class="form-group">
                    {!! Form::label('name', __('admin/general.Name: '), ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('latitude', __('admin/general.Latitude: '), ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::text('latitude', null, ['class' => 'form-control', 'dir' => 'ltr']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('longitude', __('admin/general.Longitude: '), ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::text('longitude', null, ['class' => 'form-control', 'dir' => 'ltr']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('radius', __('admin/general.Radius: '), ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::text('radius', null, ['class' => 'form-control', 'dir' => 'ltr']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('unit', __('admin/general.Unit: '), ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::select('unit',  ['kilometer' => __('admin/general.kilometer'), 'mile' => __('admin/general.mile')], null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">@lang('admin/general.Submit')</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div>
@endsection