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
    <hr>
    <strong><i class="fa fa-pencil margin-r-5"></i> Skills</strong>
    <p>
      <span class="label label-danger">UI Design</span>
      <span class="label label-success">Coding</span>
      <span class="label label-info">Javascript</span>
      <span class="label label-warning">PHP</span>
      <span class="label label-primary">Node.js</span>
    </p>
    <hr>
    <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
  </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->