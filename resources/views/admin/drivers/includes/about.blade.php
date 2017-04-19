{{-- {{dd($driver->online)}} --}}
<switch-state go-online="@lang('admin/general.Online, Go offline')"
              go-offline="@lang('admin/general.Offline, Go online')"
              error="@lang('admin/general.Driver is in trip')"
              online="{{ $driver->online ? '1' : '0' }}"
              go-online-url="{{ route('drivers.online', ['driver' => $driver]) }}"
              go-offline-url="{{ route('drivers.offline', ['driver' => $driver]) }}"></switch-state>
