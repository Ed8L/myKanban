@foreach($boardTasksArray as $boardTasks)
    @foreach($boardTasks as $boardTask)
        @if($board->id === $boardTask->board_id)
            <div class="card mb-3 boardTask-card" id="boardTask-{{ $boardTask->id }}" data-boardTaskId="{{ $boardTask->id }}">
                <a class="card-body boardTask-text" data-boardTask_id="{{ $boardTask->id }}">
                    {{ $boardTask->text }}
                </a>
            </div>
        @endif
    @endforeach
@endforeach
