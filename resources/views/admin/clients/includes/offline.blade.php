{!! Form::open(['action' => ['Admin\DriverController@offline', $driver], 'method' => 'POST']) !!}
@include('components.bootstrap.btn-warning', [
      'addClass' => isset($addClass) ? $addClass : '',
      'text' => isset($text) ? $text : '',
      'icon' => isset($icon) ? $icon : ''
      ])
{!! Form::close() !!}