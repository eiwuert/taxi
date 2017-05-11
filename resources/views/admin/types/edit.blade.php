@extends('admin.includes.layout')
@section('title')
@lang('admin/general.Car Types')
@endsection
@section('header')
@lang('admin/general.Car Types')
{!! Form::open(['action' => ['Admin\TypeController@destroy', $type], 'method' => 'DELETE', 'style' => 'display: initial;']) !!}
    <button class="btn btn-xs btn-danger" type="submit">
    <i class="ion-trash-b"></i> @lang('admin/general.Delete')
    </button>
{!! Form::close() !!}
@endsection
@section('breadcrumb')
<li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> @lang('admin/general.dashboard')</a></li>
<li class="active"><i class="ion-cube"></i> @lang('admin/general.agencies') </li>
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
                {!! Form::model($type, ['method' => 'PATCH', 'action' => ['Admin\TypeController@update', $type], 'class' => 'form-horizontal']) !!}
                <div class="form-group">
                    {!! Form::label('name', __('admin/general.Name: '), ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::text('name', null, ['class' => 'form-control']) !!}
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