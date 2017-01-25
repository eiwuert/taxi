<!DOCTYPE html>
<html>
    <head>
        <title>Not found.</title>

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
                <div class="title">Not found.</div>
                <div class="links">
                    <a href="{{ url('/') }}/">home</a>
                    <a href="{{ url('/docs') }}/">wiki</a>
                    <a href="{{ url('/admin/dashboard') }}">dashboard</a>
                    <a href="#">blog</a>
                    <a href="https://gitlab.com/amirmasoud/saam">gitlab</a>
                </div>
            </div>
        </div>
    </body>
</html>
