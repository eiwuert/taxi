@extends('admin.includes.layout')
@section('title')
@lang('admin/general.Admins')
@endsection
@section('header')
@lang('admin/general.Admins')
@endsection
@section('desc')
<a href="{{ route('users.create') }}">
    <btn-primary type="button" icon="plus" add-class="btn-xs" text="@lang('admin/general.New admin')"></btn-primary>
</a>
@endsection
@section('breadcrumb')
<li><a href="#"><i class="fa fa-dashboard"></i>@lang('admin/general.dashboard')</a></li>
<li class="active">@lang('admin/general.Admins')</li>
@endsection
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-solid">
            <!-- /.box-header -->
            <div class="box-body">
                @if (!$admins->isEmpty())
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th></th>
                            <th>@lang('admin/general.First name')</th>
                            <th>@lang('admin/general.Last name')</th>
                            <th>@lang('admin/general.Permissions')</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($admins as $admin)
                        <tr onclick="window.document.location='{{ route('users.edit', ['id' => $admin->id]) }}';" style="cursor: pointer;">
                            <td></td>
                            <td>{{ $admin->first_name }}</td>
                            <td>{{ $admin->last_name }}</td>
                            <td>
                                <table>
                                    @foreach($admin->permissions as $permission)
                                    <tr>
                                        <td>{{ config('states.' . $permission) }}</td>
                                    </tr>
                                    @endforeach
                                </table>
                            </td>
                            <td>
                            @if (Auth::user()->id != $admin->id)
                            {!! Form::open(['action' => ['Admin\WebController@destroy', $admin], 'method' => 'DELETE', 'style' => 'display: initial;']) !!}
                                <button class="btn btn-xs btn-danger" type="submit">
                                    <i class="ion-trash-b"></i> @lang('admin/general.Delete')
                                </button>
                            {!! Form::close() !!}
                            @endif
                          </td>
                        </tr>
                        @endforeach
                    </tbody>
                </tbody>
            </table>
            @else
            @include('admin.components.empty')
            @endif
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
            @include('admin.includes.pagination', ['resource' => $admins])
        </div>
    </div>
    <!-- /.box -->
</div>
@endsection
