{!! Form::open(['action' => ['Admin\ClientController@unlock', $client], 'method' => 'POST']) !!}
@include('components.bootstrap.btn-success', [
      'addClass' => isset($addClass) ? $addClass : '',
      'text' => isset($text) ? $text : '',
      'icon' => isset($icon) ? $icon : ''
      ])
{!! Form::close() !!}