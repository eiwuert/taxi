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
    <a href="{{ route('types.translate') }}">
        <button class="btn btn-info btn-xs">
            @lang('admin/general.translates')
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
                            <th>@lang('admin/general.Active')</th>
                            <th>#</th>
                            <th>@lang('admin/general.Position ')</th>
                            <th>@lang('admin/general.Icon ')</th>
                            <th>@lang('admin/general.Name')</th>
                            <th>@lang('admin/general.Sub categories')</th>
                        </tr>
                        @foreach($types as $type)
                        <tr>
                            <td>@if ($type->active) <i class="fa fa-circle-o text-green"></i> @else <i class="fa fa-circle-o text-red"></i> @endif</td>
                            <td onclick="window.document.location='{{ action('Admin\TypeController@edit', ['type' => $type]) }}';" style="cursor: pointer;"># {{ $type->id }} <i class="fa fa-pencil-square-o" aria-hidden="true"></i></td>
                            <td>{{ $type->position }}</td>
                            <td><img src="{{ asset($type->icon) }}" alt="car type icon" class="img-circle" width="48" /></td>
                            <td>{{ $type->name }}</td>
                            <td>
                                <table class="table table-bordered table-hover">
                                    <tbody>
                                        @foreach($type->children()->orderBy('position', 'asc')->get() as $child)
                                        <tr onclick="window.document.location='{{ action('Admin\TypeController@edit', ['type' => $child]) }}';" style="cursor: pointer;">
                                            <td>@if ($child->active) <i class="fa fa-circle-o text-green"></i> @else <i class="fa fa-circle-o text-red"></i> @endif</td>
                                            <td># {{ $child->id }} <i class="fa fa-pencil-square-o" aria-hidden="true"></i></td>
                                            <td>{{ $child->position }}</td>
                                            <td><img src="{{ asset($child->icon) }}" alt="car type icon" class="img-circle" width="48" /></td>
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
