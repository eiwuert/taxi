<!DOCTYPE html>
<html>
    <head>
        <title>@lang('admin/general.Not authorized')</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                color: #B0BEC5;
                display: table;
                font-weight: 100;
                font-family: 'Lato', sans-serif;
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 72px;
                margin-bottom: 40px;
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
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">@lang('admin/general.Not authorized')</div>
                <div class="links">
                    <a href="{{ url('/') }}/">@lang('admin/general.home')</a>
                    <a href="{{ url('/docs') }}/">@lang('admin/general.wiki')</a>
                    <a href="{{ url('/admin/dashboard') }}">@lang('admin/general.dashboard')</a>
                    <a href="#">@lang('admin/general.blog')</a>
                    <a href="https://gitlab.com/amirmasoud/saam">@lang('admin/general.gitlab')</a>
                </div>
            </div>
        </div>
    </body>
</html>
