{!! Form::open(['action' => ['Admin\ClientController@lock', $client], 'method' => 'POST']) !!}
@include('components.bootstrap.btn-danger', [
      'addClass' => isset($addClass) ? $addClass : '',
      'text' => isset($text) ? $text : '',
      'icon' => isset($icon) ? $icon : ''
      ])
{!! Form::close() !!}