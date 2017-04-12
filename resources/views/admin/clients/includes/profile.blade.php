<!-- Profile Image -->
<div class="box box-primary">
  <div class="box-body box-profile">
    <img src="{{ $client->getPicture() }}" alt="User profile picture" class="profile-user-img img-responsive img-circle">
    <h3 class="profile-username text-center">{{ $client->first_name or 'empty' }} {{ $client->last_name or 'empty' }}</h3>
    <p class="text-muted text-center">@lang('admin/general.Client')</p>
    <ul class="list-group list-group-unbordered">
      <li class="list-group-item">
        <b>@lang('admin/general.Trips')</b> <span class="pull-right">{{ $client->countOfTrips() }}</span>
      </li>
      <li class="list-group-item">
        <b>@lang('admin/general.Disbursement')</b> <span class="pull-right">{{ $client->disbursement() }}</span>
      </li>
      <li class="list-group-item">
        <b>@lang('admin/general.Rate')</b> <span class="pull-right">{{ $client->rate() }}</span>
      </li>
      <li class="list-group-item">
        <b>@lang('admin/general.Balance')</b> <span class="pull-right">{{ $client->balance }}</span>
      </li>
    </ul>
    <div class="row">
      <div class="col-md-6 col-xs-12">
        @include('admin.clients.includes.delete',
        ['client' => $client,
        'addClass' => 'btn-block',
        'icon' => 'trash',
        'text' => __('admin/general.Delete')])
      </div>
      <div class="col-md-6 col-xs-12">
        @if ($client->lock == true)
        @include('admin.clients.includes.unlock',
        ['client' => $client,
        'addClass' => 'btn-block',
        'icon' => 'unlock',
        'text' => __('admin/general.Unlock')])
        @else
        @include('admin.clients.includes.lock',
        ['client' => $client,
        'addClass' => 'btn-block',
        'icon' => 'lock',
        'text' => __('admin/general.Lock')])
        @endif
      </div>
    </div>
  </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->