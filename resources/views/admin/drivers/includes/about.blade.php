@if ($driver->approve == true)
  @include('admin.drivers.includes.decline',
  ['driver' => $driver,
  'addClass' => 'btn-block btn-sm',
  'icon' => 'times',
  'text' => __('admin/general.Decline')])
@else
  @include('admin.drivers.includes.approve',
  ['driver' => $driver,
  'addClass' => 'btn-block btn-sm',
  'icon' => 'check',
  'text' => __('admin/general.Approve')])
@endif
<br />
<switch-state go-online="@lang('admin/general.Online, Go offline')"
    go-offline="@lang('admin/general.Offline, Go online')"
    error="@lang('admin/general.Driver is in trip')"
    online="{{ $driver->online ? '1' : '0' }}"
    go-online-url="{{ route('drivers.online', ['driver' => $driver]) }}"
    go-offline-url="{{ route('drivers.offline', ['driver' => $driver]) }}"></switch-state>
<br />
@include('admin.drivers.includes.delete',
    ['driver' => $driver,
    'addClass' => 'btn-block btn-sm',
    'icon' => 'trash',
    'text' => __('admin/general.Delete')])
<br />
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">@lang('admin/general.Summary')</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <strong><i class="fa fa-car margin-r-5"></i> @lang('admin/general.Car')</strong>
        <p class="text-muted">
            <img src="{{ $driver->user->car->type->icon }}" alt="Car type icon" width="96" class="img-responsive center-block">
            <p class="text-center">{{ $driver->user->car->type->name }}</p>
            <p class="text-center">{{ $driver->user->car->number }}</p>
        </p>
    <hr>

    <strong><i class="fa fa-info margin-r-5"></i> @lang('admin/general.Info')</strong>
    <p class="text-muted">
        @if (! empty($driver->summary()))
        @foreach ($driver->summary() as $key => $value)
            <p><i class="fa fa-circle-o text-red"></i> {{ __('admin/general.' . $key) }} @lang('admin/general.Not filled') </p>
        @endforeach
        @else
          <p><i class="fa fa-circle-o text-green"></i> @lang('admin/general.Information complete')</p>
        @endif
    </p>
  </div>
  <!-- /.box-body -->
</div>
