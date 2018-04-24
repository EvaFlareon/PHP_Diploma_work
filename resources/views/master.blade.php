<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel @yield('title')</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>
        html, body {
            margin: 0;

            font-family: sans-serif;

            color: #636b6f;
        }

        .header {
            margin-bottom: 30px;
            padding: 15px;

            text-align: center;

            background-color: #a9c056;
        }

        .title {
            font-size: 36px;
        }

        .center {
            max-width: 1200px;
            margin: 0 auto;
        }

        .nav {
            display: inline-block;
            width: 20%;
            vertical-align: top;
        }
        .content {
            display: inline-block;
            padding: 0 10px;
            text-align: left;
        }

        .auth {
            float: left;
            margin: 10px;
        }

        .h3 {
            margin-top: 0;
        }

        .log {
            float: left;

            color: #636b6f;
        }
    </style>
</head>
<body>
@yield('content')
</body>
</html>