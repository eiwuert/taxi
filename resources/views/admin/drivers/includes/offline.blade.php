{!! Form::open(['action' => ['Admin\DriverController@offline', $driver], 'method' => 'POST']) !!}
<button class="btn btn-default btn-block btn-sm"><i class="fa fa-circle text-orange"></i> @lang('admin/general.Offline, Go online')</button>
{!! Form::close() !!}
