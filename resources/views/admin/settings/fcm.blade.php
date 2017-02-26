@extends('admin.includes.layout')
@section('header', 'FCM')
@section('breadcrumb')
<li><a href="#"><i class="ion-gear-a"></i> Setting</a></li>
<li class="active">FCM</li>
@endsection
@section('content')
<div class="box box-solid">
    <div class="box-header">
        <h3 class="box-title">FCM Logs</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive no-padding">
        <table class="table">
            <tbody>
                <tr>
                    <th>Multicast ID</th>
                    <th>Success</th>
                    <th>Failure</th>
                    <th>Canonical IDs</th>
                    <th>Results</th>
                    <th>Head</th>
                    <th>Device token</th>
                    <th>title</th>
                    <th>message</th>
                    <th>created</th>
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