<!-- About Me Box -->
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">About {{ $driver->first_name }}</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <strong><i class="fa fa-info-circle margin-r-5"></i> Status</strong>
    <p class="text-muted">
      <tag color="{{ $driver->state()->color }}">{{ $driver->state()->name }}</tag>
      @if ($driver->state()->name == 'Online')
      @include('admin.drivers.includes.offline',
      ['driver' => $driver,
      'addClass' => 'btn-block btn-xs',
      'icon' => 'check',
      'text' => 'Offline'])
      @endif
    </p>
    <hr>
    <strong><i class="fa fa-map-marker margin-r-5"></i> Last Location</strong>
    <p class="text-muted">{{ $driver->lastLocation() }}</p>
    @if (!is_null($driver->user->meta))
    <hr>
    <strong><i class="fa fa-file-o margin-r-5"></i> Documents</strong>
    <br>
    <br>
    @include('admin.drivers.includes.document', ['driver' => $driver])
    @endif
  </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->