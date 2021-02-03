<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">

    <title>My Kanban</title>
</head>

<body class="text-center">
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
        @include('components.guest-navbar')
        <main role="main" class="inner cover">
            <h1 class="cover-heading">My Kanban</h1>
            <p class="lead">
              Создай проект, с To Do списком или досками и с задачами в них, для их трекинга и эффективной работы!
            </p>
        </main>

        <footer class="mastfoot mt-auto">
            <div class="inner">
                <p>Edil Mukambetov {{ date('Y') }}</p>
            </div>
        </footer>
    </div>

    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
</body>

</html>
