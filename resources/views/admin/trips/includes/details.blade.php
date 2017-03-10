<div class="box box-solid">
    <div class="box-header">
        Details
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <table class="table">
            <thead>
                <tr>
                    <th>Status</th>
                    <th title="Estimate time of arrival">ETA</th>
                    <th>Distance</th>
                    <th title="Estimate time of departure">ETD</th>
                    <th>Driver distance</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><tag color="primary">{{ $trip->statusName() }}</tag></td>
                    <td>{{ $trip->eta_text }}</td>
                    <td>{{ $trip->distance_text }}</td>
                    <td>{{ $trip->etd_text }}</td>
                    <td>{{ $trip->driver_distance_text }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <!-- /.box-body -->
</div>