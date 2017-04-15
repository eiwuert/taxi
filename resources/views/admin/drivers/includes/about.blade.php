<!-- About Me Box -->
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">@lang('admin/general.About') {{ $driver->first_name }}</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <strong><i class="fa fa-info-circle margin-r-5"></i> @lang('admin/general.Status')</strong>
    <p class="text-muted">
      <tag color="{{ $driver->state()->color }}">{{ $driver->state()->name }}</tag>
      @if ($driver->online && $driver->approve)
      @include('admin.drivers.includes.offline',
      ['driver' => $driver,
      'addClass' => 'btn-block btn-xs',
      'icon' => 'check',
      'text' => __('admin/general.Go offline')])
      @elseif(!$driver->online && $driver->approve)
      @include('admin.drivers.includes.online',
      ['driver' => $driver,
      'addClass' => 'btn-block btn-xs',
      'icon' => 'check',
      'text' => __('admin/general.Go online')])
      @endif
    </p>
    @if (!is_null($driver->user->meta))
    <hr>
    <strong><i class="fa fa-file-o margin-r-5"></i> @lang('admin/general.Documents')</strong>
    <br>
    <br>
    @include('admin.drivers.includes.document', ['driver' => $driver])
    @endif
  </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->
@include('admin.components.googlemaps-marker')
