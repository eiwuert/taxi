@extends('admin.includes.layout')
@section('title')
@lang('admin/general.Edit state')
@endsection
@section('header')
@lang('admin/general.Edit state') «{{$state->name}}»
{!! Form::open(['action' => ['Admin\StateController@destroy', $state], 'method' => 'DELETE', 'style' => 'display: initial;']) !!}
    <button class="btn btn-xs btn-danger" type="submit">
    <i class="ion-trash-b"></i> @lang('admin/general.Delete')
    </button>
{!! Form::close() !!}
@endsection
@section('breadcrumb')
<li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> @lang('admin/general.dashboard')</a></li>
<li><a href="{{ route('states.index') }}"><i class="ion-android-map"></i> @lang('admin/general.State') </a></li>
<li class="active">@lang('admin/general.Edit')</li>
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
                {!! Form::model($state, ['method' => 'PATCH', 'action' => ['Admin\StateController@update', $state], 'class' => 'form-horizontal']) !!}

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
                        {!! Form::select('active',  ['1' => __('admin/general.Active'), '0' => __('admin/general.Inactive')], $state->active==true ? '1':'0', ['class' => 'form-control']) !!}
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