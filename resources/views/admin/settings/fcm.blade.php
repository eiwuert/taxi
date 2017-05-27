@extends('admin.includes.layout')
@section('header', 'FCM')
@section('breadcrumb')
<li><a href="#"><i class="ion-gear-a"></i>@lang('admin/general.Setting')</a></li>
<li class="active">@lang('admin/general.FCM')</li>
@endsection
@section('content')
@include('admin.charts.fcm')

<div class="box box-solid">
    <div class="box-header with-border">
        <i class="fa fa-filter"></i>
        <h3 class="box-title">@lang('admin/general.Filter')</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
    {!! Form::open(['action' => 'Admin\Setting\FcmController@filter', 'method' => 'get', 'class' => 'form-inline']) !!}
    @include('components.bootstrap.select', ['name' => 'sortby',
    'label' => __('admin/general.Sort by'),
    'items' => \App\Fcm::$sortable])
    @include('components.bootstrap.select', ['name' => 'orderby',
    'label' => __('admin/general.Order by'),
    'items' => ['asc' => __('admin/general.Ascending'), 'desc' => __('admin/general.Descending')]])
    @include('components.bootstrap.select', ['name' => 'count',
    'label' => __('admin/general.Count'),
    'items' => [15 => 15, 30 => 30, 100 => 100, 'all' => 'All']])
    {!! Form::close() !!}
    <!-- /.box-body -->
    </div>
    <div class="box-footer">
        @include('admin.components.filter')
    </div>
</div>

<div class="box box-solid">
    <div class="box-header">
        <h3 class="box-title">@lang('admin/general.FCM Logs')</h3>
        <div class="box-tools">
            {!! Form::open(['action' => 'Admin\Setting\FcmController@search', 'method' => 'get']) !!}
            <div class="input-group input-group-sm" style="width: 150px;">
                <input type="text" name="q" class="form-control pull-right" placeholder="@lang('admin/general.Search')" value="{{ Request::get('q') }}">
                <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive no-padding">
        <table class="table">
            <tbody>
                <tr>
                    <th>@lang('admin/general.Multicast ID')</th>
                    <th>@lang('admin/general.Success')</th>
                    <th>@lang('admin/general.Failure')</th>
                    <th>@lang('admin/general.Canonical IDs')</th>
                    <th>@lang('admin/general.Results')</th>
                    <th>@lang('admin/general.Backup')</th>
                    <th>@lang('admin/general.Device token')</th>
                    <th>@lang('admin/general.title')</th>
                    <th>@lang('admin/general.message')</th>
                    <th>@lang('admin/general.created')</th>
                </tr>
                @foreach($logs as $log)
                <tr>
                    <td>{!! $log['multicast_id'] !!}</td>
                    <td>{{ $log['success'] ? 'True' : 'False' }}</td>
                    <td>{{ $log['failure'] ? 'True' : 'False' }}</td>
                    <td>{{ $log['canonical_ids'] }}</td>
                    <td>
                        <table class="table-responsive">
                            <tbody>
                                @foreach($log['results'][0] as $key => $value)
                                <tr>
                                    <th>{{ $key }}: </th>
                                    <td>{{ $value }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </td>
                    <td>{{ $log['head'] }}</td>
                    <td>{{ $log['device_token'] }}</td>
                    <td>{{ $log['title'] }}</td>
                    <td>{{ $log['message'] }}</td>
                    {{-- Extracting time from _id --}}
                    <td>{{ $log->date }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="box-footer">
        @include('admin.includes.pagination', ['resource' => $logs])
    </div>
</div>
<!-- /.box -->
</div>
@endsection