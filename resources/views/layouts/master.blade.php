<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @yield('style')
    <link rel="stylesheet" href="{{ elixir('css/app.css') }}">
    <script src=" {{ elixir('js/app.js') }}"></script>
    <style>
        body{
            padding-top:60px;
        }
    </style>
</head>
<body>
@include('layouts.partial.navigation')

@include('layouts.partial.flash_message')

<div class="container">
    @yield('content')
</div>

@include('layouts.partial.footer')


@yield('script')
</body>
</html>