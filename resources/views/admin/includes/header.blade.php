<body class="hold-transition skin-blue sidebar-mini {{ $body or '' }}">
    <div class="wrapper" id="admin">
        <!-- Main Header -->
        <header class="main-header">
            <!-- Logo -->
            <a href="{{ route('dashboard') }}" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>{{ $flip[0] }}</b>{{ $app[0] }}</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>{{ $flip }}</b>{{ $app }}</span>
            </a>
            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">@lang('admin/general.Toggle navigation')</span>
                </a>
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        @if(Auth::user()->web->superadmin())
                        <!-- Notifications Menu -->
                        <li class="dropdown notifications-menu">
                            <!-- Menu toggle button -->
                            <notification-menu user-id="{{ Auth::user()->id }}" count="{{ Auth::user()->unreadNotifications->count() }}"></notification-menu>
                            <ul class="dropdown-menu">
                                <li>
                                    <!-- Inner Menu: contains the notifications -->
                                    <ul class="menu">
                                        <notification-client-count user-id="{{ Auth::user()->id }}"
                                        count="{{ Auth::user()->countOfRegisteredClients() }}"
                                        href="{{ route('clients.filter') }}?ids={!! Auth::user()->newClientIds() !!}&markAsRead=&#10003;">
                                        </notification-client-count>
                                        <notification-driver-count user-id="{{ Auth::user()->id }}"
                                        count="{{ Auth::user()->countOfRegisteredDrivers() }}"
                                        href="{{ route('drivers.filter') }}?ids={!! Auth::user()->newDriverIds() !!}&markAsRead=&#10003;">
                                        </notification-driver-count>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        @endif
                        <!-- User Account Menu -->
                        <li class="dropdown user user-menu">
                            <!-- Menu Toggle Button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <!-- The user image in the navbar-->
                                {{ HTML::image(Auth::user()->web->picture, 'User Image', ['class' => 'user-image']) }}
                                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                <span class="hidden-xs">{{ $first_name }}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- The user image in the menu -->
                                <li class="user-header">
                                    {{ HTML::image(Auth::user()->web->picture, 'User Image', ['class' => 'img-circle']) }}
                                    <p>
                                        {{ $first_name }} {{ $last_name }}
                                    </p>
                                </li>
                                <li class="user-body">
                                    <div class="row">
                                        <div class="col-xs-12 text-center">
                                            <a href="{{ route('switch') }}">@lang('admin/general.Switch to Farsi')</a>
                                        </div>
                                    </div>
                                    <!-- /.row -->
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="{{ route('users.edit', ['id' => Auth::user()->web->id]) }}" class="btn btn-default btn-flat">@lang('admin/general.Profile')</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="{{ url('/logout') }}" class="btn btn-default btn-flat"
                                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                            @lang('admin/general.Logout')
                                        </a>
                                        <form id="logout-form" action="{{ url('fa/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>