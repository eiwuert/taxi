{!! Form::open(['action' => ['Admin\DriverController@approve', $driver], 'method' => 'POST']) !!}
@include('components.bootstrap.btn-default', [
      'addClass' => isset($addClass) ? $addClass : '',
      'text' => isset($text) ? $text : '',
      'icon' => isset($icon) ? $icon : ''
      ])
{!! Form::close() !!}
