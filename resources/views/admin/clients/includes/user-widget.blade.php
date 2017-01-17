<div class="box box-widget widget-user">
  <!-- Add the bg color to the header using any of the bg-* classes -->
  <div class="widget-user-header bg-gray disabled color-palette">
    <h3 class="widget-user-username">{{ $client->first_name }} {{ $client->last_name }}</h3>
    <h5 class="widget-user-desc"><i class="ion-android-walk"></i> <i>{{ ucfirst($client->user->role) }}</i></h5>
    <h6><a href="{{ route('clients.show', [$client]) }}" target="blank"><i class="ion-share"></i> Go to profile</a></h6>
  </div>
  <div class="widget-user-image">
    <img class="img-circle" src="{{ $client->picture }}" alt="User Avatar">
  </div>
  <div class="box-footer">
    <div class="row">
      <div class="col-sm-4 border-right">
        <div class="description-block">
          <h5 class="description-header">{{ number_format($client->trips->count()) }}</h5>
          <span class="description-text">TRIPS</span>
        </div>
        <!-- /.description-block -->
      </div>
      <!-- /.col -->
      <div class="col-sm-4 border-right">
        <div class="description-block">
          <h5 class="description-header">$ {{ $client->disbursement() }}</h5>
          <span class="description-text">DISBURSEMENT</span>
        </div>
        <!-- /.description-block -->
      </div>
      <!-- /.col -->
      <div class="col-sm-4">
        <div class="description-block">
          <h5 class="description-header">{{ $client->rate() }}</h5>
          <span class="description-text">RATE</span>
        </div>
        <!-- /.description-block -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
</div>