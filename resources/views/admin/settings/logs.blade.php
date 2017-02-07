@extends('admin.includes.layout')
@section('header', 'Logs')
@section('breadcrumb')
<li><a href="#"><i class="ion-gear-a"></i> Setting</a></li>
<li class="active">Logs</li>
@endsection
@section('content')
<div class="box box-solid">
    <div class="box-header">
        <h3 class="box-title">System Logs</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive no-padding">
        <table class="table">
            <tbody>
                @foreach($logs as $log)
                <tr>
                    <td><pre>{!! $log !!}</pre></td>
                </tr>
                @endforeach
            </tbody></table>
        </div>
    </div>
    <!-- /.box -->
</div>
@endsection