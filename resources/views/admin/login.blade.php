@extends('admin.includes.page')
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
                @include('components.bootstrap.email')
                @include('components.bootstrap.password')
                <div class="row">
                    <div class="col-xs-8">
                        @include('components.bootstrap.checkbox',
                        ['name' => 'remember',
                        'label' => 'Remember Me'])
                    </div>
                    <div class="col-xs-4">
                        @include('components.bootstrap.btn-primary',
                        ['text' => 'Sign in',
                        'addClass' => 'btn-block btn-flat'])
                    </div>
                    @include('components.bootstrap.btn-link', 
                        ['href' => url('/password/reset'),
                        'text' => 'Forgot Your Password?'])
                </div>
            </form>
        </div>
        <!-- /.login-box-body -->
    </div>
    @stop
    @section('footer')
    @stop