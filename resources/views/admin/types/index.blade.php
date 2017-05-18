@extends('admin.includes.layout')
@section('title')
@lang('admin/general.Car type')
@endsection
@section('header')
<a href="{{ route('types.create') }}">
    <button class="btn btn-primary btn-xs">
    @lang('admin/general.New car type')
    </button>
</a> 
@lang('admin/general.Car type')
@endsection
@section('breadcrumb')
<li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> @lang('admin/general.dashboard')</a></li>
<li class="active"><i class="ion-cube"></i> @lang('admin/general.Car type') </li>
@endsection
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-solid">
            <div class="box-header">
                <h3 class="box-title">@lang('admin/general.List')</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                @if(!$types->isEmpty())
                <table class="table table-striped table-hover">
                    <tbody>
                        <tr>
                            <th>#</th>
                            <th>@lang('admin/general.Name')</th>
                            <th>@lang('admin/general.Sub categories')</th>
                        </tr>
                        @foreach($types as $type)
                        <tr>
                            <td onclick="window.document.location='{{ action('Admin\TypeController@edit', ['type' => $type]) }}';" style="cursor: pointer;"># {{ $type->id }}</td>
                            <td>{{ $type->name }}</td>
                            <td>
                                <table class="table table-bordered table-hover">
                                    <tbody>
                                        @foreach($type->children as $child)
                                        <tr onclick="window.document.location='{{ action('Admin\TypeController@edit', ['type' => $child]) }}';" style="cursor: pointer;">
                                            <td>{{ $child->name }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                @include('admin.components.empty')
                @endif
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
                @include('admin.includes.pagination', ['resource' => $types])
            </div>
        </div>
        <!-- /.box -->
    </div>
</div>
@endsection