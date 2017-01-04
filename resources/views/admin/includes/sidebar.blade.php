  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          {{ HTML::image('img/user2-160x160.jpg', 'User Image', ['class' => 'img-circle']) }}
        </div>
        <div class="pull-left info">
          <p>{{ $first_name }}</p>
          <!-- Status -->
          <a href="#"><i class="fa fa-user text-default"></i> Admin</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <!-- Optionally, you can add icons to the links -->
        <li class="active"><a href="#"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        <li><a href="{{ route('drivers.index') }}"><i class='ion-model-s'></i> <span>Drivers</span></a></li>
        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>Multilevel</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#">Link in level 2</a></li>
            <li><a href="#">Link in level 2</a></li>
          </ul>
        </li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>
