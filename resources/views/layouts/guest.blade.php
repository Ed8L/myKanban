<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'My Kanban') }}</title>

        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
        @yield('styles')
    </head>
    <body>
        <div class="container p-3">
        @include('components.guest-navbar')
        @yield('content')
        </div>
    </body>
</html>
