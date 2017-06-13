@extends('admin.includes.layout')
@section('header', 'SMS')
@section('breadcrumb')
<li><a href="#"><i class="ion-gear-a"></i>@lang('admin/general.Setting')</a></li>
<li class="active">SMS codes</li>
@endsection
@section('content')
<div class="box box-solid">
    <div class="box-header">
        <h3 class="box-title">@lang('admin/general.SMS codes')</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive no-padding">
        <table class="table">
            <tbody>
                <tr>
                    <th></th>
                    <th>@lang('admin/general.Name')</th>
                    <th>@lang('admin/general.Phone')</th>
                    <th>@lang('admin/general.Code')</th>
                    <th>@lang('admin/general.Attempts')</th>
                    <th>@lang('admin/general.Generated')</th>
                </tr>
                @foreach($codes as $code)
                <tr>
                    <td><img src="{{ $code->picture }}"
                             alt="User profile picture"
                             class="img-responsive img-circle"
                             width="24"></td>
                    <td>{!! $code->name or '<tag color="default">In progress</tag>' !!}</td>
                    <td>{!! $code->phone or '<tag color="success">Registering</tag>' !!}</td>
                    <td>{{ $code->code }}</td>
                    <td>{{ $code->attempts }}</td>
                    <td>{{ $code->created_at->diffForHumans() }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="box-footer">
        @include('admin.includes.pagination', ['resource' => $codes])
    </div>
</div>
<!-- /.box -->
</div>
@endsection
