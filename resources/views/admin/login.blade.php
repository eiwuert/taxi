@extends('admin.includes.page')

@section('style')
<link rel="stylesheet" href="{{ elixir('css/admin/iCheckBlue.css') }}">
@stop

@section('content')
<body class="hold-transition login-page">
<div class="login-box" id="admin">
  <div class="login-logo">
    <a href="{{ url('/') }}"><b>SAAM</b>Taxi</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <form action="{{ url('admin/login') }}" method="POST" role="form">
      {{-- @include('admin.errors.form', ['errors' => $errors]) --}}
      {{ csrf_field() }}
      @include('admin.components.email')
      @include('admin.components.password')
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" name="remember"> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <a class="btn btn-link" href="{{ url('/password/reset') }}">
            Forgot Your Password?
        </a>
        <!-- /.col -->
      </div>
    </form>

  </div>
  <!-- /.login-box-body -->
</div>
@stop

@section('footer')
<script src="{{ elixir('js/admin/icheck.js') }}"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue'
    });
  });
</script>
@stop
