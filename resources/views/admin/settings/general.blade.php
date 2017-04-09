@extends('admin.includes.layout')
@section('header')
@lang('admin/general.General')
@endsection
@section('breadcrumb')
<li><a href="#"><i class="fa fa-dashboard"></i>@lang('admin/general.Settings') </a></li>
<li class="active">@lang('admin/general.General')</li>
@endsection
@section('content')
<form method="post" action="{{ action('Admin\Setting\GeneralController@update') }}" class="form-horizontal">
    <input type="hidden" name="_method" value="PATCH">
    {{ csrf_field() }}
    @foreach($options as $option)
    <div class="form-group">
        <label class="col-sm-2 control-label" id="name">{{ $option->name }}</label>
        <div class="col-sm-10">
            <input type="{{ is_numeric($option->value) ? 'number' : 'text' }}" name="{{ $option->name }}" class="form-control" value="{{ $option->value }}">
        </div>
    </div>
    @endforeach
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary">@lang('admin/general.Submit')</button>
        </div>
    </div>
</form>
@endsection