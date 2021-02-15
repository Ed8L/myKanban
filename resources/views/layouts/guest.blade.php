<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'My Kanban') }}</title>

        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/guest.css') }}">
        @yield('styles')
    </head>
    <body class="text-center">
        <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
            @include('components.guest_navbar')
            <main role="main" class="inner cover">
                @yield('content')
            </main>

            <footer class="mastfoot mt-auto">
                <p>Edil Mukambetov {{ date('Y') }}</p>
            </footer>
        </div>
    </body>
</html>
