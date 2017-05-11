@extends('admin.includes.layout')
@section('title')
@lang('admin/general.Fare')
@endsection
@section('header')
@lang('admin/general.Fare')
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
            <div class="box-body" id="fare">
                {!! Form::model($fare, ['method' => 'POST', 'action' => ['Admin\FareController@store'], 'class' => 'form-horizontal']) !!}
                @include('admin.fares.includes.form', ['types' => $types, 'zones' => $zones])
                {!! Form::close() !!}
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div>
@endsection