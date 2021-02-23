@if (!empty($todo))
    <form method="POST" action="{{ route('todo.destroy', $project->id) }}">
        @csrf
        @method('DELETE')
        <input type="hidden" value="{{ $project->id }}" name="id">
        <a class="nav-link action" href="" onclick="event.preventDefault();
                                        this.closest('form').submit();">
            Удалить ToDo
        </a>
    </form>
@else
    <form method="POST" action="{{ route('todo.store') }}">
        @csrf
        <input type="hidden" value="{{ $project->id }}" name="id">
        <a class="nav-link action" href="" onclick="event.preventDefault();
                                        this.closest('form').submit();">
            Создать ToDo
        </a>
    </form>
@endif
