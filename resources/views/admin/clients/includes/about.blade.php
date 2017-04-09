<!-- About Me Box -->
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">@lang('admin/general.About') {{ $client->first_name }}</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <strong><i class="fa fa-info-circle margin-r-5"></i> @lang('admin/general.Status')</strong>
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
    <strong><i class="fa fa-map-marker margin-r-5"></i> @lang('admin/general.Last Location')</strong>
    <p class="text-muted">{{ $client->lastLocation() }}</p>
    <hr>
    <strong><i class="fa fa-pencil margin-r-5"></i> @lang('admin/general.Skills')</strong>
    <p>
      <span class="label label-danger">@lang('admin/general.UI Design')</span>
      <span class="label label-success">@lang('admin/general.Coding')</span>
      <span class="label label-info">@lang('admin/general.Javascript')</span>
      <span class="label label-warning">@lang('admin/general.PHP')</span>
      <span class="label label-primary">@lang('admin/general.Node')</span>
    </p>
    <hr>
    <strong><i class="fa fa-file-text-o margin-r-5"></i>@lang('admin/general.Notes') </strong>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
  </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->