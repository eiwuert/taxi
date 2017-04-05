<!-- About Me Box -->
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">About {{ $client->first_name }}</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <strong><i class="fa fa-info-circle margin-r-5"></i> Status</strong>
    <p class="text-muted">
      <tag color="{{ $client->state()->color }}">{!! $client->state()->name !!}</tag>
      @if ($client->state()->name == 'Online')
      @include('admin.clients.includes.offline',
      ['client' => $client,
      'addClass' => 'btn-block btn-xs',
      'icon' => 'check',
      'text' => 'Offline'])
      @endif
    </p>
    <hr>
    <strong><i class="fa fa-map-marker margin-r-5"></i> Last Location</strong>
    <p class="text-muted">{{ $client->lastLocation() }}</p>
  </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->