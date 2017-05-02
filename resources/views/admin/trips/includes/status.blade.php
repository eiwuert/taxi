@if(Auth::user()->web->superadmin())
<div class="row">
  <div class="col-md-12">
    <div class="box box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">@lang('admin/general.Monthly Recap Report')</h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <div class="row">
          <div class="col-md-4">
            <a href="{{ route('trips.filter', ['status' => 'reject_client_found']) }}">
              @include('admin.components.progress', ['name' => __('admin/general.Driver rejected client'), 'progress' => $progress['4'], 'total' => $progress['total']])
            </a>
            <a href="{{ route('trips.filter', ['status' => 'no_driver']) }}">
              @include('admin.components.progress', ['name' => __('admin/general.No driver'), 'progress' => $progress['5'], 'total' => $progress['total']])
            </a>
            <a href="{{ route('trips.filter', ['status' => 'driver_reject_started_trip']) }}">
              @include('admin.components.progress', ['name' => __('admin/general.Driver rejected started trip'), 'progress' => $progress['8'], 'total' => $progress['total']])
            </a>
            <a href="{{ route('trips.filter', ['status' => 'driver_cancel_arrived_status']) }}">
              @include('admin.components.progress', ['name' => __('admin/general.Driver rejected on arrived status'), 'progress' => $progress['14'], 'total' => $progress['total']])
            </a>
          </div>
          <!-- /.col -->
          <div class="col-md-4">
            <a href="{{ route('trips.filter', ['status' => 'reject_client_found']) }}">
              @include('admin.components.progress', ['name' => __('admin/general.Client canceled requested taxi'), 'progress' => $progress['10'], 'total' => $progress['total']])
            </a>
            <a href="{{ route('trips.filter', ['status' => 'cancel_onway_driver']) }}">
              @include('admin.components.progress', ['name' => __('admin/general.Client canceled onway driver'), 'progress' => $progress['11'], 'total' => $progress['total']])
            </a>
            <a href="{{ route('trips.filter', ['status' => 'client_canceled_arrived_driver']) }}">
              @include('admin.components.progress', ['name' => __('admin/general.Client canceled arrived driver'), 'progress' => $progress['13'], 'total' => $progress['total']])
            </a>
            <a href="{{ route('trips.filter', ['status' => 'trip_is_over_by_admin']) }}">
              @include('admin.components.progress', ['name' => __('admin/general.Trip is over by admin'), 'progress' => $progress['18'], 'total' => $progress['total']])
            </a>
          </div>
          <!-- /.col -->
          <div class="col-md-4">
            <a href="{{ route('trips.filter', ['status' => 'trip_is_over']) }}">
              @include('admin.components.progress', ['name' => __('admin/general.Trip is over'), 'progress' => $progress['17'], 'total' => $progress['total']])
            </a>
            <a href="{{ route('trips.filter', ['status' => 'trip_ended']) }}">
              @include('admin.components.progress', ['name' => __('admin/general.Trip ended not rated'), 'progress' => $progress['9'], 'total' => $progress['total']])
            </a>
            <a href="{{ route('trips.filter', ['status' => 'driver_rated']) }}">
              @include('admin.components.progress', ['name' => __('admin/general.Driver rated not yet client'), 'progress' => $progress['15'], 'total' => $progress['total']])
            </a>
            <a href="{{ route('trips.filter', ['status' => 'client_rated']) }}">
              @include('admin.components.progress', ['name' => __('admin/general.Client rated not yet driver'), 'progress' => $progress['16'], 'total' => $progress['total']])
            </a>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- ./box-body -->
    </div>
    <!-- /.box -->
  </div>
  <!-- /.col -->
</div>
@endif