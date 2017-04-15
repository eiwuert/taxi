@extends('admin.includes.page')
@section('content')
<body class="hold-transition login-page">
    <div class="login-box" id="admin">
        <div class="login-logo">
            <a href="{{ url('/') }}">{{ config('app.name') }}</a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <form action="{{ url('admin/login') }}" method="POST" role="form">
                {{ csrf_field() }}
                @include('components.bootstrap.danger-status')
                @include('components.bootstrap.email')
                @include('components.bootstrap.password')
                <div class="row">
                    <div class="col-xs-8">
                        @include('components.bootstrap.checkbox',
                        ['name' => 'remember',
                        'label' => __('admin/general.Remember Me')])
                    </div>
                    <div class="col-xs-4">
                        @include('components.bootstrap.btn-primary',
                        ['text' => __('admin/general.Sign in'),
                        'addClass' => 'btn-block btn-flat'])
                    </div>
                    @include('components.bootstrap.btn-link', 
                        ['href' => url('/password/reset'),
                        'text' => __('admin/general.Forgot Your Password?')])
                </div>
            </form>
        </div>
        <!-- /.login-box-body -->
    </div>
@endsection