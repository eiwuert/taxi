@if (!is_null($trip->transaction))
<div class="box box-solid">
    <div class="box-header">
        <h3 class="box-title">@lang('admin/general.Invoice')</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-md-12 table-responsive">
                <table class="table table-striped table-hover">
                    <tbody>
                        <tr>
                            <th>@lang('admin/general.Entry')</th>
                            <th>@lang('admin/general.Distance')</th>
                            <th>@lang('admin/general.Per distance')</th>
                            <th>@lang('admin/general.Time')</th>
                            <th>@lang('admin/general.Per time')</th>
                        </tr>
                        <tr>
                            <td>{{ $trip->transaction->entry }}</td>
                            <td>{{ $trip->transaction->distance }}</td>
                            <td>{{ $trip->transaction->per_distance }} / {{ $trip->transaction->distance_unit }}</td>
                            <td>{{ $trip->transaction->time }}</td>
                            <td>{{ $trip->transaction->per_time }} / {{ $trip->transaction->time_unit }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 table-responsive">
                <table class="table">
                    <tbody>
                        <tr>
                            <th colspan="2">Details</th>
                        </tr>
                        <tr>
                            <th style="width:50%">Currency:</th>
                            <td>{{ $trip->transaction->currency }}</td>
                        </tr>
                        <tr>
                            <th>Car type:</th>
                            <td>{{ ucfirst($trip->transaction->type->name) }}</td>
                        </tr>
                        <tr>
                            <th>Time zone:</th>
                            <td>{{ $trip->transaction->timezone }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-6 table-responsive">
                <table class="table">
                    <tbody>
                        <tr>
                            <th colspan="2">Charged</th>
                        </tr>
                        <tr>
                            <th style="width:50%">Subtotal:</th>
                            <td>{{ $trip->transaction->withoutSurcharge() }}</td>
                        </tr>
                        <tr>
                            <th>Surcharge:</th>
                            <td>× {{ $trip->transaction->surcharge }}</td>
                        </tr>
                        <tr>
                            <th>Total:</th>
                            <td>{{ number_format($trip->transaction->total) }}</td>
                        </tr>
                        <tr>
                            <th>Our share:</th>
                            <td>{{ number_format($trip->transaction->ourShare()) }} ({{ $trip->transaction->ourCommission() }})</td>
                        </tr>
                        <tr>
                            <th>Driver share:</th>
                            <td>{{ number_format($trip->transaction->driverShare()) }} ({{ $trip->transaction->driverCommission() }})</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /.box-body -->
</div>
@endif