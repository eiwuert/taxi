<div class="box box-solid widget-trips-pie">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="ion-android-navigate"></i>  @lang('admin/general.Trip status')</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-md-offset-3 col-md-6">
                <div id="canvas-holder"><canvas id="chart-area"/></div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.box-body -->
    <div class="box-footer text-center">
        <a href="{{ route('clients.index') }}" class="uppercase">@lang('admin/general.View all trips')</a>
    </div>
    <!-- /.box-footer -->
</div>
    @push('js')
    <script src="{{ mix('js/admin/chart.js') }}"></script>
    <script type="text/javascript">
    var config = {
    type: 'pie',
    data: {
        datasets: [{
            data: [
                parseInt({{ $countOfFinishedTrips }}),
                parseInt({{ $countOfCancelledTrips }}),
            ],
            backgroundColor: [
                'rgb(75, 192, 192)', // Green
                'rgb(255, 99, 132)', // Red
            ]
        }],
        labels: [
            "@lang('admin/general.Finished')",
            "@lang('admin/general.Canceled')",
        ]
        },
        options: {
            responsive: true
        }
    };
    window.onload = function() {
        var ctx = document.getElementById("chart-area").getContext("2d");
        window.myPie = new Chart(ctx, config);
    };

    </script>
    @endpush