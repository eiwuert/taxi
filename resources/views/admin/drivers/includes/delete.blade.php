{!! Form::open(['action' => ['Admin\DriverController@destroy', $driver], 'method' => 'DELETE']) !!}
@include('components.bootstrap.btn-default', [
      'addClass' => isset($addClass) ? $addClass : '',
      'text' => isset($text) ? $text : '',
      'icon' => isset($icon) ? $icon : ''
      ])
{!! Form::close() !!}
