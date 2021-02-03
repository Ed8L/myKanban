<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', 'My Kanban')</title>

        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    </head>
    <body>
        @yield('content')
    </body>
</html>