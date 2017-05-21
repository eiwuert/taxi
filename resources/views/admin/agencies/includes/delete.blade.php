{!! Form::open(['action' => ['Admin\AgencyController@destroy', $agency], 'method' => 'DELETE']) !!}
@include('components.bootstrap.btn-danger', [
      'addClass' => isset($addClass) ? $addClass : '',
      'text' => isset($text) ? $text : '',
      'icon' => isset($icon) ? $icon : ''
      ])
{!! Form::close() !!}