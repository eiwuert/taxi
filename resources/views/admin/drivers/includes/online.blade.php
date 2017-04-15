{!! Form::open(['action' => ['Admin\DriverController@online', $driver], 'method' => 'POST']) !!}
@include('components.bootstrap.btn-success', [
      'addClass' => isset($addClass) ? $addClass : '',
      'text' => isset($text) ? $text : '',
      'icon' => isset($icon) ? $icon : ''
      ])
{!! Form::close() !!}