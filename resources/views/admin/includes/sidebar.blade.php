<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                {{ HTML::image(Auth::user()->web->picture, 'User Image', ['class' => 'img-circle']) }}
            </div>
            <div class="pull-right info">
                <p>{{ $first_name }}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-user text-default"></i>@lang('admin/general.Admin') </a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <!-- Optionally, you can add icons to the links -->
            <li class="{{ (str_contains(Request::url(), route('dashboard'))) ? 'active' : '' }}"><a href="{{ route('dashboard') }}"><i class="ion-speedometer"></i><span>@lang('admin/general.Dashboard') </span></a></li>
            <li class="{{ (str_contains(Request::url(), route('drivers.index'))) ? 'active' : '' }}"><a href="{{ route('drivers.index') }}"><i class='ion-model-s'></i><span>@lang('admin/general.Drivers') </span></a></li>
            @if (Auth::user()->web->superadmin())
            <li class="{{ (str_contains(Request::url(), route('clients.index'))) ? 'active' : '' }}"><a href="{{ route('clients.index') }}"><i class='ion-android-walk'></i><span> @lang('admin/general.Clients')</span></a></li>
            @endif
            <li class="{{ (str_contains(Request::url(), route('trips.index'))) ? 'active' : '' }}"><a href="{{ route('trips.index') }}"><i class='ion-android-navigate'></i><span>  @lang('admin/general.Trips')</span></a></li>
            <li class="{{ (str_contains(Request::url(), route('maps.index'))) ? 'active' : '' }}"><a href="{{ route('maps.index') }}"><i class='ion-ios-location'></i><span> @lang('admin/general.Maps')</span></a></li>
            @if (Auth::user()->web->superadmin())
            <li class="{{ (str_contains(Request::url(), route('agencies.index'))) ? 'active' : '' }}"><a href="{{ route('agencies.index') }}"><i class='ion-person-stalker'></i><span> @lang('admin/general.Agencies')</span></a></li>
            <li class="{{ (str_contains(Request::url(), route('contacts.index'))) ? 'active' : '' }}"><a href="{{ route('contacts.index') }}"><i class='ion-paper-airplane'></i><span> @lang('admin/general.Contact')</span>@include('admin.includes.badge', ['string' => $countOfContacts])</a></li>
            <li class="{{ (str_contains(Request::url(), route('types.index'))) ? 'active' : '' }}"><a href="{{ route('types.index') }}"><i class='ion-cube'></i><span> @lang('admin/general.Car types')</span></a></li>
            <li class="{{ (str_contains(Request::url(), route('states.index'))) ? 'active' : '' }}"><a href="{{ route('states.index') }}"><i class='ion-android-map'></i><span> @lang('admin/general.States')</span></a></li>
            <li class="{{ (str_contains(Request::url(), route('zones.index'))) ? 'active' : '' }}"><a href="{{ route('zones.index') }}"><i class='ion-pinpoint'></i><span> @lang('admin/general.Zone')</span></a></li>
            <li class="{{ (str_contains(Request::url(), route('currencies.index'))) ? 'active' : '' }}"><a href="{{ route('currencies.index') }}"><i class='ion-pricetags'></i><span> @lang('admin/general.Currency')</span></a></li>
            <li class="{{ (str_contains(Request::url(), 'fares')) ? 'treeview active' : 'treeview' }}">
                <a href="#"><i class="ion-cash"></i> <span>@lang('admin/general.Fare')</span> @include('admin.includes.angle')</a>
                <ul class="treeview-menu">
                    <li class="{{ (str_contains(Request::url(), route('fares.index'))) ? 'active' : '' }}"><a href="{{ route('fares.index') }}"><i class='ion-cash'></i><span> @lang('admin/general.Fare')</span></a></li>
                    <li class="{{ (str_contains(Request::url(), route('fares.calculator'))) ? 'active' : '' }}"><a href="{{ route('fares.calculator') }}"><i class='ion-calculator'></i><span> @lang('admin/general.Calculator')</span></a></li>
                </ul>
            </li>
            @endif
            <li class="{{ (str_contains(Request::url(), 'admin/payments')) ? 'treeview active' : 'treeview' }}">
                <a href="#"><i class="ion-card"></i> <span>@lang('admin/general.Payments')</span>
                @include('admin.includes.angle')
            </a>
            <ul class="treeview-menu">
                <li class="{{ (ends_with(Request::url(), route('payments.index'))) ? 'active' : '' }}"><a href="{{ route('payments.index') }}">@lang('admin/general.All')</span></a></li>
                <li class="{{ (ends_with(Request::url(), 'drivers') || ends_with(Request::url(), 'trips')) ? 'active' : '' }}"><a href="{{ route('payments.drivers') }}">@lang('admin/general.Drivers')</span></a></li>
            </ul>
        </li>
        @if(Auth::user()->web->superadmin())
        <li class="{{ (str_contains(Request::url(), 'admin/settings')) ? 'treeview active' : 'treeview' }}">
            <a href="#"><i class="ion-gear-a"></i> <span>@lang('admin/general.Settings')</span>
            @include('admin.includes.angle')
        </a>
        <ul class="treeview-menu">
            <li class="{{ (str_contains(Request::url(), route('settings.general.index'))) ? 'active' : '' }}"><a href="{{ route('settings.general.index') }}">@lang('admin/general.General')</a></li>
            <li class="{{ (str_contains(Request::url(), route('settings.backup.index'))) ? 'active' : '' }}"><a href="{{ route('settings.backup.index') }}">@lang('admin/general.Backup')</a></li>
            <li class="{{ (str_contains(Request::url(), route('settings.logs.index'))) ? 'active' : '' }}"><a href="{{ route('settings.logs.index') }}">@lang('admin/general.Logs')</a></li>
            <li class="{{ (str_contains(Request::url(), route('settings.fcm.index'))) ? 'active' : '' }}"><a href="{{ route('settings.fcm.index') }}">@lang('admin/general.FCM')</a></li>
            <li class="{{ (str_contains(Request::url(), route('settings.requests.index'))) ? 'active' : '' }}"><a href="{{ route('settings.requests.index') }}">@lang('admin/general.Requests')</a></li>
            <li class="{{ (str_contains(Request::url(), route('settings.sms.index'))) ? 'active' : '' }}"><a href="{{ route('settings.sms.index') }}">@lang('admin/general.Sms')</a></li>
            <li class="{{ (str_contains(Request::url(), route('users.index'))) ? 'active' : '' }}"><a href="{{ route('users.index') }}">@lang('admin/general.Admins')</a></li>
        </ul>
    </li>
    @endif
</ul>
<!-- /.sidebar-menu -->
</section>
<!-- /.sidebar -->
</aside>
