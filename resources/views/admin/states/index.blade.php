@extends('admin.includes.layout')
@section('title')
@lang('admin/general.States')
@endsection
@section('header')
<a href="{{ route('states.create') }}">
    <button class="btn btn-primary btn-xs">
    @lang('admin/general.New state')
    </button>
</a> 
@lang('admin/general.States')
@endsection
@section('breadcrumb')
<li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> @lang('admin/general.dashboard')</a></li>
<li class="active"><i class="ion-android-map"></i> @lang('admin/general.States') </li>
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
                @if(!$states->isEmpty())
                <table class="table table-striped table-hover">
                    <tbody>
                        <tr>
                            <th></th>
                            <th>@lang('admin/general.Name')</th>
                            <th>@lang('admin/general.Status')</th>
                        </tr>
                        @foreach($states as $state)
                        <tr onclick="window.document.location='{{ action('Admin\StateController@edit', ['state' => $state]) }}';" style="cursor: pointer;">
                            <td># {{ $state->id }}</td>
                            <td>{{ $state->name }}</td>
                            <td>{!! $state->status() !!}</td>
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
                @include('admin.includes.pagination', ['resource' => $states])
            </div>
        </div>
        <!-- /.box -->
    </div>
</div>
@endsection