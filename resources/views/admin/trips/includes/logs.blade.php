<div class="box box-solid">
    <div class="box-header">
        <h3 class="box-title">@lang('admin/general.Logs')</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-md-12 table-responsive">
                <table class="table">
                    <tbody>
                        @php
                            $prev = $trip->logs[0]->created_at;
                        @endphp
                        @foreach($trip->logs as $key => $log)
                        <tr>
                            <th style="width:50%">{{ (!$key) ? $log->created_at : ($log->created_at->diffForHumans($prev) . ' ' .$log->after($key)) }}</th>
                            @php $prev = $log->created_at; @endphp
                            <td>{{ $log->statusName($log) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /.box-body -->
</div>