<body class="hold-transition skin-blue sidebar-mini {{ $body or '' }}">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="{{ route('dashboard') }}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>{{ $saam[0] }}</b>{{ $taxi[0] }}</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>{{ $saam }}</b>{{ $taxi }}</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Notifications Menu -->
          <li class="dropdown notifications-menu">
            <!-- Menu toggle button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">{{ Auth::user()->unreadNotifications->count() }}</span>
            </a>
            <ul class="dropdown-menu">
              <li>
                <!-- Inner Menu: contains the notifications -->
                <ul class="menu">
                  @if (Auth::user()->countOfRegisteredClients() > 0)
                  <li><!-- start notification -->
                    <a href="{{ route('clients.filter') }}?ids={!! Auth::user()->newClientIds() !!}&markAsRead=&#10003;">
                      {!! Auth::user()->newClientsNotificationText() !!}
                    </a>
                  </li>
                  <!-- end notification -->
                  @endif
                  @if (Auth::user()->countOfRegisteredDrivers())
                  <li><!-- start notification -->
                    <a href="{{ route('drivers.filter') }}?ids={!! Auth::user()->newDriverIds() !!}&markAsRead=&#10003;">
                      {!! Auth::user()->newDriversNotificationText() !!}
                    </a>
                  </li>
                  <!-- end notification -->
                  @endif
                </ul>
              </li>
            </ul>
          </li>
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              {{ HTML::image('img/user2-160x160.jpg', 'User Image', ['class' => 'user-image']) }}
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs">{{ $first_name }}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                {{ HTML::image('img/user2-160x160.jpg', 'User Image', ['class' => 'img-circle']) }}

                <p>
                  {{ $first_name }} {{ $last_name }}
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="{{ url('/logout') }}" class="btn btn-default btn-flat"  
                      onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                      Logout
                  </a>

                  <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
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
