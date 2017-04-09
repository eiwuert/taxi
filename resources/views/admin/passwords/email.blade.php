@extends('admin.includes.page')
@section('content')
<body class="hold-transition login-page">
    <div class="login-box" id="admin">
        <div class="login-logo">
            <a href="{{ url('/') }}"><b>@lang('admin/general.SAAM')</b>Taxi</a>
            <p>@lang('admin/general.Reset Password')</p>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            @include('components.bootstrap.success-status')
            <form role="form" method="POST" action="{{ url('/password/email') }}">
                {{ csrf_field() }}
                @include('components.bootstrap.email')
                @include('components.bootstrap.btn-primary', [
                    'text' => 'Send Password Reset Link',
                    'addClass' => 'btn-flat btn-block'])
            </form>
        </div>
        <!-- /.login-box-body -->
    </div>
@endsection