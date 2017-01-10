@extends('admin.includes.layout')
@section('title')
drivers
@endsection
@section('header')
Drivers
@endsection
@section('breadcrumb')
<li><a href="#"><i class="fa fa-dashboard"></i> dashboard</a></li>
<li class="active">drivers</li>
@endsection
@section('content')
      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              {{ HTML::image('img/' . $driver->picture, 'User profile picture', ['class' => 'profile-user-img img-responsive img-circle']) }}

              <h3 class="profile-username text-center">{{ $driver->first_name or 'empty' }} {{ $driver->last_name or 'empty' }}</h3>

              <p class="text-muted text-center">Driver</p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Trips</b> <a class="pull-right">{{ $driver->countOfTrips() }}</a>
                </li>
                <li class="list-group-item">
                  <b>Income</b> <a class="pull-right">{{ $driver->income() }}</a>
                </li>
                <li class="list-group-item">
                  <b>Rate</b> <a class="pull-right">{{ $driver->rate() }}</a>
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

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">About {{ $driver->first_name }}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-info-circle margin-r-5"></i> Status</strong>

              <p class="text-muted">
                <tag color="{{ $driver->state()->color }}">{{ $driver->state()->name }}</tag>
              </p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Last Location</strong>

              <p class="text-muted">{{ $driver->lastLocation() }}</p>

              <hr>

              <strong><i class="fa fa-pencil margin-r-5"></i> Skills</strong>

              <p>
                <span class="label label-danger">UI Design</span>
                <span class="label label-success">Coding</span>
                <span class="label label-info">Javascript</span>
                <span class="label label-warning">PHP</span>
                <span class="label label-primary">Node.js</span>
              </p>

              <hr>

              <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>

              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#timeline" data-toggle="tab">Timeline</a></li>
              <li><a href="#info" data-toggle="tab">Info</a></li>
              <li><a href="#car" data-toggle="tab">Car</a></li>
            </ul>
            <div class="tab-content">
              <!-- /.tab-pane -->
              <div class="active tab-pane" id="timeline">
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
                    @if (! is_null($t->firstTransaction()))
                    <!-- timeline item -->
                    <li>
                      <i class="fa fa-money bg-aqua"></i>
                      <div class="timeline-item">
                        <span class="time"><i class="fa fa-clock-o"></i> {{ ($t->firstTransaction()->created_at->diffForHumans()) }}</span>

                        <h3 class="timeline-header">Transaction</h3>

                        <div class="timeline-body">
                          <p><b>Entry: </b>{{ $t->sourceName() }}</p>
                          <p><b>Distance: </b>{{ $t->firstTransaction()->distance_value }}</p>
                          <p><b>Time: </b>{{ $t->firstTransaction()->time_value }}</p>
                          <p><b>Surcharge: </b>{{ $t->firstTransaction()->surcharge }}</p>
                          <p><b>Currency: </b>{{ $t->firstTransaction()->currency }}</p>
                          <p><b>Timezone: </b>{{ $t->firstTransaction()->timezone }}</p>
                          <p><b>Total: </b>{{ $t->firstTransaction()->total }}</p>
                        </div>
                      </div>
                    </li>
                    <!-- END timeline item -->
                    @endif
                    @if (! is_null($t->rate()->first()))
                    @if ($t->rataOfClientToDriver()->client != '')
                    <!-- timeline item -->
                    <li>
                      <i class="fa fa-star bg-yellow"></i>

                      <div class="timeline-item">
                        <span class="time"><i class="fa fa-clock-o"></i> {{ $t->rate()->first()->created_at->diffForHumans() }}</span>

                        <h3 class="timeline-header">Client @include('admin.includes.stars', ['stars' => $t->rataOfClientToDriver()->client ])</h3>

                        <div class="timeline-body">
                          {{ $t->rataOfClientToDriver()->client_comment }}
                        </div>
                      </div>
                    </li>
                    <!-- END timeline item -->
                    @endif
                    @if ($t->rateOfDriverToClient()->driver != '')
                    <!-- timeline item -->
                    <li>
                      <i class="fa fa-star bg-yellow"></i>

                      <div class="timeline-item">
                        <span class="time"><i class="fa fa-clock-o"></i> {{ $t->rate()->first()->created_at->diffForHumans() }}</span>

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
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="info">
                {!! Form::model($driver, ['method' => 'PATCH', 'action' => ['Admin\DriverController@update', $driver->id], 'class' => 'form-horizontal']) !!}
                  <div class="form-group">
                    {!! Form::label('phone', 'Phone: ', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                      {!! Form::text('phone', $driver->PhoneNumber(), ['class' => 'form-control', 'disabled' => 'disabled']) !!}
                    </div>
                  </div>
                  <div class="form-group">
                    {!! Form::label('first_name', 'First name: ', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                      {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
                    </div>
                  </div>
                  <div class="form-group">
                    {!! Form::label('last_name', 'Last name: ', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                      {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
                    </div>
                  </div>
                  <div class="form-group">
                    {!! Form::label('email', 'Email: ', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                      {!! Form::text('email', null, ['class' => 'form-control']) !!}
                    </div>
                  </div>
                  <div class="form-group">
                    {!! Form::label('gender', 'Gender: ', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                      {!! Form::select('gender', ['male' => 'male', 'female' => 'female', 'not specified'=>'not specified'], 
                                      null, ['class' => 'form-control']) !!}
                    </div>
                  </div>
                  <div class="form-group">
                    {!! Form::label('address', 'Address: ', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                      {!! Form::text('address', null, ['class' => 'form-control']) !!}
                    </div>
                  </div>
                  <div class="form-group">
                    {!! Form::label('state', 'State: ', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                      {!! Form::text('state', null, ['class' => 'form-control']) !!}
                    </div>
                  </div>
                  <div class="form-group">
                    {!! Form::label('country', 'Country: ', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                      {!! Form::text('country', null, ['class' => 'form-control']) !!}
                    </div>
                  </div>
                  <div class="form-group">
                    {!! Form::label('zipcode', 'Zip code: ', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                      {!! Form::text('zipcode', null, ['class' => 'form-control']) !!}
                    </div>
                  </div>
                  <div class="box-group" id="accordion">
                    <div class="panel box box-primary">
                      <div class="box-header">
                        <h4 class="box-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" class="">
                            More <i class="fa fa-angle-down"></i>
                          </a>
                        </h4>
                      </div>
                      <div id="collapseOne" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                        <div class="box-body">
                          <div class="form-group">
                            {!! Form::label('lang', 'Lang: ', ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-10">
                              {!! Form::select('lang', ['fa' => 'Farsi', 'en' => 'English', 'ku' => 'Kurdi'], null, ['class' => 'form-control']) !!}
                            </div>
                          </div>
                          <div class="form-group">
                            {!! Form::label('device_token', 'Device token: ', ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-10">
                              {!! Form::text('device_token', null, ['class' => 'form-control']) !!}
                            </div>
                          </div>
                          <div class="form-group">
                            {!! Form::label('device_type', 'Device type: ', ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-10">
                              {!! Form::select('device_type', ['android' => 'Android', 'ios' => 'iOS', 'web' => 'Web'], null, ['class' => 'form-control']) !!}
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                  </div>
                {!! Form::close() !!}
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="car">
                {!! Form::model($driver->car(), ['method' => 'PATCH', 'action' => ['Admin\CarController@update', $driver->car()], 'class' => 'form-horizontal']) !!}
                  <div class="form-group">
                    {!! Form::label('number', 'Number: ', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                      {!! Form::text('number', null, ['class' => 'form-control data-mask-plate', 'dir' => 'auto']) !!}
                    </div>
                  </div>
                  <div class="form-group">
                    {!! Form::label('color', 'Color: ', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                      {!! Form::text('color', null, ['class' => 'form-control']) !!}
                    </div>
                  </div>
                  <div class="form-group">
                    {!! Form::label('type_id', 'Type: ', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                      {!! Form::select('type_id', $driver->carTypesPluck(), null, ['class' => 'form-control']) !!}
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                  </div>
                {!!  Form::close() !!}
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

@endsection

@push('js')
  <script src="{{ elixir('js/admin/jquery.inputmask.js') }}"></script>
  <script type="text/javascript">
    $(function () { 
      $(".data-mask-plate").inputmask();
    });
  </script>
@endpush