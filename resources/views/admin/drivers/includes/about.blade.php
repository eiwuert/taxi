{{-- {{dd($driver->online)}} --}}
<switch-state go-online="@lang('admin/general.Online, Go offline')"
              go-offline="@lang('admin/general.Offline, Go online')"
              online="{{ $driver->online ? '1' : '0' }}"
              driver="{{ $driver->id }}"></switch-state>
