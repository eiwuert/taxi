@extends('admin.includes.layout')
@section('header')
@lang('admin/general.Changelog')
@endsection
@section('breadcrumb')
<li><a href="#"><i class="fa fa-dashboard"></i> @lang('admin/general.Settings')</a></li>
<li class="active">@lang('admin/general.Changelog')</li>
@endsection
@section('content')
<pre style="direction: ltr !important;">
    <code>
    <b>v1 changes:</b>
    * Add changes log
    </code>
</pre>
@endsection