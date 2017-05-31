@extends('admin.includes.layout')
@section('title')
@lang('admin/general.Car Types')
@endsection
@section('header')
@lang('admin/general.Car Types')
@endsection
@section('breadcrumb')
<li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> @lang('admin/general.dashboard')</a></li>
<li class="active"><i class="ion-android-walk"></i>@lang('admin/general.Car types') </li>
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
                {!! Form::open(['method' => 'POST', 'action' => ['Admin\TypeController@store'], 'class' => 'form-horizontal', 'files' => true]) !!}
                <div class="form-group">
                    {!! Form::label('name', __('admin/general.Name: '), ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('icon', __('admin/general.Icon: '), ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::file('icon', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('active', __('admin/general.Active: '), ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::select('active', ['0' => __('admin/general.Deactive'), '1' => __('admin/general.Active')], null, ['class' => 'from-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('position', __('admin/general.Position: '), ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-md-10">
                        <div class="checkbox">
                            <label>
                                {!! Form::select('position', $position, null) !!}
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('children', __('admin/general.Children: '), ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-md-10">
                        @foreach($types as $key => $type)
                        <div class="checkbox">
                            <label>
                                {!! Form::checkbox('children[]', $key) !!} {{ $type }}
                            </label>
                        </div>
                        @endforeach
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
