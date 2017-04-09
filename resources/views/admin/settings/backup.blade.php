@extends('admin.includes.layout')
@section('header')
@lang('admin/general.Backup')
@endsection
@section('desc')
<a href="{{ route('settings.backup.new') }}">
    <btn-primary type="button" icon="plus" add-class="btn-xs" text="@lang('admin/general.New backup')"></btn-primary>
</a>
@endsection
@section('breadcrumb')
<li><a href="#"><i class="ion-gear-a"></i>@lang('admin/general.Setting') </a></li>
<li class="active">@lang('admin/general.Backup')</li>
@endsection
@section('content')
<div class="box box-solid">
    <div class="box-header">
        <h3 class="box-title">@lang('admin/general.List of backups')</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive no-padding">
        <table class="table table-striped table-hover">
            <tbody>
                <tr>
                    <th>@lang('admin/general.Name')</th>
                    <th>@lang('admin/general.Size')</th>
                    <th>@lang('admin/general.Extension')</th>
                    <th>@lang('admin/general.Permissions')</th>
                    <th>@lang('admin/general.Created')</th>
                    <th></th>
                </tr>
                @foreach($backups as $b)
                <tr>
                    <td>{{ $b->getFilename() }}</td>
                    <td>{{ number_format($b->getSize() / pow(2, 20), 2) }} MB</td>
                    <td>{{ $b->getExtension() }}</td>
                    <td>{{ substr(sprintf('%o', $b->getPerms()), -4) }}</td>
                    <td>{{ 'Created ' . \Carbon\Carbon::createFromTimestamp($b->getCTime())->diffForHumans() }}</td>
                    <td>
                        <a href="{{ route('settings.backup.delete', ['file' => $b->getFilename()]) }}">
                            <btn-danger type="button" icon="trash" add-class="btn-xs"></btn-danger>
                        </a>
                        <a href="{{ route('settings.backup.download', ['file' => $b->getFilename()]) }}">
                        <btn-primary type="button" icon="cloud-download" add-class="btn-xs"></btn-primary>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody></table>
        </div>
    </div>
    <!-- /.box -->
</div>
@endsection