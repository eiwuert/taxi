@extends('admin.includes.layout')
@section('header', 'Logs')
@section('breadcrumb')
<li><a href="#"><i class="ion-gear-a"></i> @lang('admin/general.Setting')</a></li>
<li class="active">@lang('admin/general.Logs')</li>
@endsection
@section('content')
<div class="box box-solid">
    <div class="box-header">
        <h3 class="box-title">@lang('admin/general.System Logs')</h3>
        <span> | </span>
        <small>@lang('admin/general.Only last 100 items listed here')</small>
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive no-padding">
        <table class="table">
            <tbody>
                @foreach($logs as $log)
                <tr>
                    <td><pre style="direction: ltr;">{!! $log !!}</pre></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<!-- /.box -->
</div>
@endsection