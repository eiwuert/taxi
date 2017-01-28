<!-- The timeline -->
<ul class="timeline timeline-inverse">
  @foreach($driver->inverseTrips()->with('rate', 'transaction')->paginate(config('admin.perPage')) as $t)
  <!-- timeline time label -->
  <li class="time-label">
    <span class="label-primary">
      {{ $t->updated_at->diffForHumans() }}
    </span>
  </li>
  <!-- /.timeline-label -->
  <!-- timeline item -->
  <li>
    <i class="fa fa-motorcycle label-primary"></i>
    <div class="timeline-item">
      <span class="time"><i class="fa fa-clock-o"></i> {{ $t->created_at->diffForHumans() }}</span>
      <h3 class="timeline-header"><tag color="primary">{{ $t->statusName() }}</tag></h3>
      <div class="timeline-body">
        <p><b>From: </b>{{ $t->sourceName() }}</p>
        <p><b>To: </b>{{ $t->destinationName() }}</p>
        <p><b>Distance: </b>{{ $t->distance_text }}</p>
        <p><b>Time: </b>{{ $t->eta_text }}</p>
        <p><b>Distance to client: </b>{{ $t->driver_distance_text }}</p>
        <p><b>Time to client: </b>{{ $t->etd_text }}</p>
      </div>
    </div>
  </li>
  <!-- END timeline item -->
  @if (! is_null($transaction = $t->transaction))
  <!-- timeline item -->
  <li>
    <i class="fa fa-money bg-aqua"></i>
    <div class="timeline-item">
      <span class="time"><i class="fa fa-clock-o"></i> {{ ($transaction->created_at->diffForHumans()) }}</span>
      <h3 class="timeline-header">Transaction</h3>
      <div class="timeline-body">
        <p><b>Entry: </b>{{ $transaction->entry }}</p>
        <p><b>Distance: </b>{{ $transaction->distance_value }}</p>
        <p><b>Time: </b>{{ $transaction->time_value }}</p>
        <p><b>Surcharge: </b>{{ $transaction->surcharge }}</p>
        <p><b>Currency: </b>{{ $transaction->currency }}</p>
        <p><b>Timezone: </b>{{ $transaction->timezone }}</p>
        <p><b>Total: </b>{{ $transaction->total }}</p>
      </div>
    </div>
  </li>
  <!-- END timeline item -->
  @endif
  @if (! is_null($t->rate))
  @if ($t->rataOfClientToDriver()->client != '')
  <!-- timeline item -->
  <li>
    <i class="fa fa-star bg-yellow"></i>
    <div class="timeline-item">
      <span class="time"><i class="fa fa-clock-o"></i> {{ $t->rate->created_at->diffForHumans() }}</span>
      <h3 class="timeline-header">Client @include('admin.includes.stars', ['stars' => $t->rataOfClientToDriver()->client ])</h3>
      @if( $t->rataOfClientToDriver()->client_comment != '' )
      <div class="timeline-body">
        {{ $t->rataOfClientToDriver()->client_comment }}
      </div>
      @endif
    </div>
  </li>
  @endif
  <!-- END timeline item -->
  @if ($t->rateOfDriverToClient()->driver != '')
  <!-- timeline item -->
  <li>
    <i class="fa fa-star bg-yellow"></i>
    <div class="timeline-item">
      <span class="time"><i class="fa fa-clock-o"></i> {{ $t->rate->created_at->diffForHumans() }}</span>
      <h3 class="timeline-header">Driver @include('admin.includes.stars', ['stars' => $t->rateOfDriverToClient()->driver ])</h3>
      @if( $t->rateOfDriverToClient()->driver_comment != '' )
      <div class="timeline-body">
        {{ $t->rateOfDriverToClient()->driver_comment }}
      </div>
      @endif
    </div>
  </li>
  <!-- END timeline item -->
  @endif
  @endif
  <!-- timeline item -->
  <li>
    <i class="fa fa-user bg-purple"></i>
    <div class="timeline-item">
      <span class="time"><i class="fa fa-clock-o"></i> {{ $t->client->created_at->diffForHumans() }}</span>
      <h3 class="timeline-header"><a href="{{ route('clients.show', [$t->client]) }}">{{ $t->client->first_name or 'null' }} {{ $t->client->last_name or 'null' }}</a></h3>
      <div class="timeline-body">
        <p><b>Phone: </b>{{ $t->client->phoneNumber() }}</p>
        <p><b>Email: </b>{{ $t->client->email or 'null' }}</p>
        <p><b>Gender: </b>{{ $t->client->gender or 'null' }}</p>
        <p><b>Device type: </b>{{ $t->client->device_type or 'null' }}</p>
        <p><b>Address: </b>{{ $t->client->address or 'null' }}</p>
        <p><b>State: </b>{{ $t->client->state or 'null' }}</p>
        <p><b>Country: </b>{{ $t->client->country or 'null' }}</p>
        <p><b>Zipcode: </b>{{ $t->client->zipcode or 'null' }}</p>
      </div>
    </div>
  </li>
  <!-- END timeline item -->
  @endforeach
  @if (is_null($driver->trips))
  <li>
    <i class="fa fa-pause" aria-hidden="true"></i>
    <div class="timeline-item">
    <h3 class="timeline-header">Fresh as a daisy</a></h3>
    <div class="timeline-body">
      <br>
      <p class="text-center">Nothing to show here...</p>
      <br>
    </div>
  </div>
  </li>
  @endif
  <li>
    <i class="fa fa-clock-o bg-gray"></i>
  </li>
</ul>
@include('admin.includes.pagination', ['resource' => $driver->inverseTrips()->with('rate', 'transaction')->paginate(config('admin.perPage'))])
<!-- END The timeline -->