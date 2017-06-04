<!DOCTYPE html>
<html>
    <head>
        <title>@lang('admin/general.Not found')</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="{{ mix('css/admin/admin.css') }}">
        <link rel="stylesheet" href="{{ mix('css/admin/rtl.css') }}">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'IRANSans', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    <a href="{{ url('fa/admin/login') }}">@lang('admin/general.Login')</a>
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    404
                </div>

                <div class="links">
                    <a href="{{ url('/docs') }}/">@lang('admin/general.wiki')</a>
                    <a href="{{ url('/fa/admin/dashboard') }}">@lang('admin/general.dashboard')</a>
                    <a href="#">@lang('admin/general.blog')</a>
                    <a href="https://gitlab.com/amirmasoud/saam">GITLab</a>
                </div>
            </div>
        </div>
    </body>
</html>
