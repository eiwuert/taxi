@extends('admin.includes.page')
@section('content')
<body class="hold-transition login-page">
    <div class="login-box" id="admin">
        <div class="login-logo">
            <a href="{{ url('/') }}"><b>SAAM</b>Taxi</a>
            <p>Reset Password</p>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            @if (session('status'))
            <alert-success text="{{ session('status') }}"></alert-success>
            @endif
            <form role="form" method="POST" action="{{ url('/password/reset') }}">
                {{ csrf_field() }}
                <input type="hidden" name="token" value="{{ $token }}">
                @include('components.bootstrap.email')
                @include('components.bootstrap.password')
                @include('components.bootstrap.password', [
                    'name' => 'password_confirmation',
                    'label' => 'Confirm Password',
                    'placeholder' => 'Confirm Password'])
                @include('components.bootstrap.btn-primary', [
                    'text' => 'Reset Password',
                    'addClass' => 'btn-flat btn-block'])
            </form>
        </div>
        <!-- /.login-box-body -->
    </div>
@endsection