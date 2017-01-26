@extends('admin.includes.layout')
@section('header')
Backup
@endsection
@section('desc')
<a href="{{ route('settings.backup.new') }}">
    <btn-primary type="button" icon="plus" add-class="btn-xs" text="New backup"></btn-primary>
</a>
@endsection
@section('breadcrumb')
<li><a href="#"><i class="ion-gear-a"></i> Setting</a></li>
<li class="active">General</li>
@endsection
@section('content')
<div class="box box-solid">
    <div class="box-header">
        <h3 class="box-title">List of backups</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive no-padding">
        <table class="table table-striped table-hover">
            <tbody>
                <tr>
                    <th>Name</th>
                    <th>Size</th>
                    <th>Extension</th>
                    <th>Permissions</th>
                    <th>Created</th>
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