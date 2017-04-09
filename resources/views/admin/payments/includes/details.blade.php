<div class="row">
    <div class="col-xs-12">
        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">@lang('admin/general.Details')</h3>
            </div>
            <div class="box-body">
                <table class="table table-responsive table-striped">
                    <tbody>
                        <tr>
                            <th colspan="2">@lang('admin/general.Transaction details')</th>
                        </tr>
                        @foreach($payment->detail as $key => $value)
                        <tr>
                            <th>{{ $key }}</th>
                            <td>{{ $value }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>