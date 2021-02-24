@foreach($boardTasksArray as $boardTasks)
    @foreach($boardTasks as $boardTask)
        @if($board->id === $boardTask->board_id)
            <div class="card mb-3 boardTask-card">
                <div class="card-body">
                    {{ $boardTask->text }}
                </div>
            </div>
        @endif
    @endforeach
@endforeach
