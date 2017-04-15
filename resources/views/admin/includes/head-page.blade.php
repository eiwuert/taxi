<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>@lang('admin/general.SAAMTaxi') &bull; @yield('title', '')</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="{{ elixir('css/admin/admin.css') }}">
        <script src="http://{{ Request::getHost() }}:6001/socket.io/socket.io.js"></script>
        @if (\Request::segment(1) == 'fa')
        <link rel="stylesheet" href="{{ elixir('css/admin/rtl.css') }}">
        @endif
        @stack('style')
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>