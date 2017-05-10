@extends('admin.includes.layout')
@section('title')
@lang('admin/general.Agencies')
@endsection
@section('header')
<a href="{{ route('agencies.create') }}">
    <button class="btn btn-primary btn-xs">
    @lang('admin/general.New agency')
    </button>
</a> 
@lang('admin/general.Agencies')
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
            <div class="box-body table-responsive no-padding">
                @if(!$agencies->isEmpty())
                <table class="table table-striped table-hover">
                    <tbody>
                        <tr>
                            <th></th>
                            <th>@lang('admin/general.Phone')</th>
                            <th>@lang('admin/general.Address')</th>
                            <th>@lang('admin/general.State')</th>
                            <th>@lang('admin/general.Created at')</th>
                            <th>@lang('admin/general.Updated at')</th>
                        </tr>
                        @foreach($agencies as $agency)
                        <tr onclick="window.document.location='{{ action('Admin\AgencyController@edit', ['agency' => $agency]) }}';" style="cursor: pointer;">
                            <td># {{ $agency->id }}</td>
                            <td>{{ $agency->phone }}</td>
                            <td>{{ $agency->address }}</td>
                            <td>{{ config('states')[$agency->state] }}</td>
                            <td>{{ $agency->created_at->diffForHumans() }}</td>
                            <td>{{ $agency->updated_at->diffForHumans() }}</td>
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
                @include('admin.includes.pagination', ['resource' => $agencies])
            </div>
        </div>
        <!-- /.box -->
    </div>
</div>
@endsection