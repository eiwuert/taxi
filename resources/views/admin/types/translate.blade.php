@extends('admin.includes.layout')
@section('title')
    @lang('admin/general.Car Types Trans')
@endsection
@section('header')
    @lang('admin/general.Car Types Trans')
@endsection
@section('breadcrumb')
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> @lang('admin/general.dashboard')</a></li>
    <li><a href="{{ route('types.index') }}"><i class="ion-cube"></i> @lang('admin/general.Car type')</a></li>
    <li class="active">@lang('admin/general.translates')</li>
@endsection
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-solid">
                <div class="box-header">
                    <h3 class="box-title">@lang('admin/general.List') @lang('admin/general.translates')</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body" id="car-types" style="margin-top: 50px">
                    {!! Form::open(['method' => 'PATCH', 'action' => ['Admin\TypeController@updateTranslates'], 'class' => 'form-horizontal']) !!}
                    <div class="box-group" id="accordion">
                        @foreach($types as $type)
                            <div class="panel box">
                                <div class="box-header with-border">
                                    <h4 class="box-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#{{ $type->slug }}" aria-expanded="false" class="collapsed">
                                            {{ $type->slug }}
                                        </a>
                                    </h4>
                                </div>
                                <div id="{{ $type->slug }}" class="panel-collapse collapse" aria-expanded="false" style="height: 0">
                                    <div class="box-body">
                                        @foreach(config('app.locales') as $locale)
                                        <div class="form-group">
                                                {!! Form::label('trans['.$locale.'][' . $type->slug . ']', __('admin/general.'.$locale), ['class' => 'col-sm-2 control-label']) !!}
                                                <div class="col-sm-10">
                                                    {!! Form::text('trans['.$locale.']['. $type->slug . ']',translateMe($locale,'car_types',$type->slug), ['class' => 'form-control']) !!}
                                                </div>
                                        </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="form-group" style="margin-top: 30px">
                        <div class="col-sm-4 col-sm-offset-4">
                            <button type="submit" class="btn btn-block btn-primary">@lang('admin/general.Submit')</button>
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