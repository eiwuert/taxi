<!-- Profile Image -->
<div class="box box-primary">
  <div class="box-body box-profile">
    <img src="{{ $driver->getPicture() }}" alt="User profile picture" class="profile-user-img img-responsive img-circle">
    <h3 class="profile-username text-center">{{ $driver->first_name or 'empty' }} {{ $driver->last_name or 'empty' }}</h3>
    <p class="text-muted text-center">@lang('admin/general.Driver')</p>
    <ul class="list-group list-group-unbordered">
      <li class="list-group-item">
        <b>@lang('admin/general.Trips')</b> <sapn class="pull-right">{{ $driver->countOfTrips() }}</span>
      </li>
      <li class="list-group-item">
        <b>@lang('admin/general.Income')</b> <span class="pull-right">{{ $driver->income() }}</span>
      </li>
      <li class="list-group-item">
        <b>@lang('admin/general.Rate')</b> <span class="pull-right">{{ $driver->rate() }}</span>
      </li>
    </ul>
    <div class="row">
      <div class="col-md-6 col-xs-12">
        @include('admin.drivers.includes.delete',
        ['driver' => $driver,
        'addClass' => 'btn-block',
        'icon' => 'trash',
        'text' => 'Delete'])
      </div>
      <div class="col-md-6 col-xs-12">
        @if ($driver->approve == true)
        @include('admin.drivers.includes.decline',
        ['driver' => $driver,
        'addClass' => 'btn-block',
        'icon' => 'times',
        'text' => 'Decline'])
        @else
        @include('admin.drivers.includes.approve',
        ['driver' => $driver,
        'addClass' => 'btn-block',
        'icon' => 'check',
        'text' => 'Approve'])
        @endif
      </div>
    </div>
  </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->