@extends('admin.includes.page')
@section('title', __('admin/general.Login'))
@section('content')
<body class="hold-transition login-page">
    <div class="login-box" id="admin">
        <div class="login-logo">
            <img class="img img-responsive center-block" src="{{ asset('images/logo-512.png') }}" width="128">
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <form action="{{ url('fa/admin/login') }}" method="POST" role="form">
                {{ csrf_field() }}
                @include('components.bootstrap.danger-status')
                @include('components.bootstrap.email')
                @include('components.bootstrap.password')
                <div class="row">
                    <div class="col-xs-12">
                        @include('components.bootstrap.checkbox',
                        ['name' => 'remember',
                        'label' => __('admin/general.Remember Me')])
                    </div>
                </div>
                <hr />
                <div class="row">
                    <div class="col-xs-12">
                        @include('components.bootstrap.btn-primary',
                        ['text' => __('admin/general.Sign in'),
                        'addClass' => 'btn-block btn-flat',
                        'icon'     => 'angle-double-right'])
                    </div>
                </div>
            </form>
        </div>
        <!-- /.login-box-body -->
    </div>
@endsection