{{-- {{dd($driver->online)}} --}}
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
