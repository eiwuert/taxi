<!-- The timeline -->
<ul class="timeline timeline-inverse">
  @foreach($driver->inverseTrips()->get() as $t)
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
  @if (! is_null($transaction = $t->firstTransaction()))
  <!-- timeline item -->
  <li>
    <i class="fa fa-money bg-aqua"></i>
    <div class="timeline-item">
      <span class="time"><i class="fa fa-clock-o"></i> {{ ($transaction->created_at->diffForHumans()) }}</span>
      <h3 class="timeline-header">Transaction</h3>
      <div class="timeline-body">
        <p><b>Entry: </b>{{ $t->sourceName() }}</p>
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
  @if (! is_null($rate = $t->rate()->first()))
  @if ($t->rataOfClientToDriver()->client != '')
  <!-- timeline item -->
  <li>
    <i class="fa fa-star bg-yellow"></i>
    <div class="timeline-item">
      <span class="time"><i class="fa fa-clock-o"></i> {{ $rate->created_at->diffForHumans() }}</span>
      <h3 class="timeline-header">Client @include('admin.includes.stars', ['stars' => $t->rataOfClientToDriver()->client ])</h3>
      <div class="timeline-body">
        {{ $t->rataOfClientToDriver()->client_comment }}
      </div>
    </div>
  </li>
  @endif
  <!-- END timeline item -->
  @if ($t->rateOfDriverToClient()->driver != '')
  <!-- timeline item -->
  <li>
    <i class="fa fa-star bg-yellow"></i>
    <div class="timeline-item">
      <span class="time"><i class="fa fa-clock-o"></i> {{ $rate->created_at->diffForHumans() }}</span>
      <h3 class="timeline-header">Driver @include('admin.includes.stars', ['stars' => $t->rateOfDriverToClient()->driver ])</h3>
      <div class="timeline-body">
        {{ $t->rateOfDriverToClient()->driver_comment }}
      </div>
    </div>
  </li>
  <!-- END timeline item -->
  @endif
  @endif
  <!-- timeline item -->
  <li>
    <i class="fa fa-user bg-purple"></i>
    <div class="timeline-item">
      @foreach ($t->client()->get() as $c)
      <span class="time"><i class="fa fa-clock-o"></i> {{ $c->created_at->diffForHumans() }}</span>
      <h3 class="timeline-header">{{ $c->first_name or 'null' }} {{ $c->last_name or 'null' }}</h3>
      <div class="timeline-body">
        <p><b>Phone: </b>{{ $c->phoneNumber() }}</p>
        <p><b>Email: </b>{{ $c->email or 'null' }}</p>
        <p><b>Gender: </b>{{ $c->gender or 'null' }}</p>
        <p><b>Device type: </b>{{ $c->device_type or 'null' }}</p>
        <p><b>Address: </b>{{ $c->address or 'null' }}</p>
        <p><b>State: </b>{{ $c->state or 'null' }}</p>
        <p><b>Country: </b>{{ $c->country or 'null' }}</p>
        <p><b>Zipcode: </b>{{ $c->zipcode or 'null' }}</p>
      </div>
      @endforeach
    </div>
  </li>
  <!-- END timeline item -->
  @endforeach
  <li>
    <i class="fa fa-clock-o bg-gray"></i>
  </li>
</ul>
<!-- END The timeline -->