@extends('admin.includes.layout')
@section('title')
@lang('admin/general.New state')
@endsection
@section('header')
@lang('admin/general.New state')
@endsection
@section('breadcrumb')
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> @lang('admin/general.dashboard')</a></li>
    <li><a href="{{ route('states.index') }}"><i class="ion-android-map"></i> @lang('admin/general.State') </a></li>
    <li class="active">@lang('admin/general.Create')</li>
@endsection
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-solid">
            <div class="box-header">
                <h3 class="box-title"></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                {!! Form::open(['method' => 'POST', 'action' => ['Admin\StateController@store'], 'class' => 'form-horizontal']) !!}
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    {!! Form::label('name', __('admin/general.Name: '), ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::text('name', null, ['class' => 'form-control']) !!}
                        @if ($errors->has('name'))
                            <span class="help-block ">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('active') ? ' has-error' : '' }}">
                    {!! Form::label('active', __('admin/general.Status: '), ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::select('active',  ['1' => __('admin/general.Active'), '0' => __('admin/general.Inactive')], null, ['class' => 'form-control']) !!}
                        @if ($errors->has('active'))
                            <span class="help-block ">
                                        <strong>{{ $errors->first('active') }}</strong>
                                    </span>
                        @endif
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