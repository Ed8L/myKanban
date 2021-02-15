<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="{{ route('userProfile') }}">My Kanban</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('userProfile') }}">Профиль</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Настройки профиля</a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <form method="POST" action="{{ route('logout') }}" class="logout-form">
                    @csrf

                    <a class="logout_btn nav-link"
                       onclick="event.preventDefault();
                                            this.closest('form').submit();">
                        {{ __('Выход') }}
                    </a>
                </form>
            </li>
        </ul>
    </div>
</nav>
