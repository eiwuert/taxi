@extends('admin.includes.layout')
@section('title')
@lang('admin/general.Profile')
@endsection
@section('header')
@lang('admin/general.Profile')
@endsection
@section('breadcrumb')
<li><a href="#"><i class="fa fa-dashboard"></i>@lang('admin/general.dashboard')</a></li>
<li class="active">@lang('admin/general.Profile')</li>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        @include('admin.errors.form')
        {!! Form::model($profile, ['method' => 'PATCH', 'action' => ['Admin\WebController@update', $profile->id], 'class' => 'form-horizontal', 'files' => true]) !!}
        <div class="form-group">
            {!! Form::label('first_name', __('admin/general.First name: '), ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
                {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
                <p class="help-block">@lang('admin/general.Max 24 characters.')</p>
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('last_name', __('admin/general.Last name: '), ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
                {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
                <p class="help-block">@lang('admin/general.Max 24 characters')</p>
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('picture', __('admin/general.Picture: '), ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
                {!! Form::file('picture', ['class' => 'form-control']) !!}
            </div>
        </div>
        @if (Auth::user()->web->superadmin())
        <div class="form-group">
            {!! Form::label('permissions', __('admin/general.Permission: '), ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-md-10">
                @foreach(config('states') as $key => $value)
                {!! Form::checkbox('permissions[]', $key) !!} {{ $value }} <br/>
                @endforeach
            </div>
        </div>
        @endif
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">@lang('admin/general.Submit')</button>
            </div>
        </div>
        {!! Form::close() !!}
        {!! Form::model($profile->user, ['method' => 'PATCH', 'action' => ['Admin\WebController@updateEmail', $profile->id], 'class' => 'form-horizontal', 'files' => true]) !!}
        <div class="form-group">
            {!! Form::label('email', __('admin/general.Email: '), ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
                {!! Form::text('email', null, ['class' => 'form-control', 'dir' => 'ltr']) !!}
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">@lang('admin/general.Submit')</button>
            </div>
        </div>
        {!! Form::close() !!}
        {!! Form::model($profile, ['method' => 'PATCH', 'action' => ['Admin\WebController@updatePassword', $profile->id], 'class' => 'form-horizontal', 'files' => true]) !!}
        <div class="form-group">
            {!! Form::label('password', __('admin/general.Password: '), ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
                {!! Form::password('password', ['class' => 'form-control', 'dir' => 'ltr']) !!}
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">@lang('admin/general.Submit')</button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
@endsection