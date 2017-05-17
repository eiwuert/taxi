@extends('admin.includes.layout')
@section('title')
@lang('admin/general.Agencies')
@endsection
@section('header')
@lang('admin/general.Agencies')
{!! Form::open(['action' => ['Admin\AgencyController@destroy', $agency], 'method' => 'DELETE', 'style' => 'display: initial;']) !!}
    <button class="btn btn-xs btn-danger" type="submit">
    <i class="ion-trash-b"></i> @lang('admin/general.Delete')
    </button>
{!! Form::close() !!}
@endsection
@section('breadcrumb')
<li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> @lang('admin/general.dashboard')</a></li>
<li class="active"><i class="ion-android-walk"></i>@lang('admin/general.agencies') </li>
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
                {!! Form::model($agency, ['method' => 'PATCH', 'action' => ['Admin\AgencyController@update', $agency], 'class' => 'form-horizontal']) !!}
                <div class="form-group">
                    {!! Form::label('phone', __('admin/general.Phone: '), ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::textarea('phone', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('address', __('admin/general.Address: '), ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::textarea('address', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('state', __('admin/general.State: '), ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::select('state', \App\Agency::states($agency), null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
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