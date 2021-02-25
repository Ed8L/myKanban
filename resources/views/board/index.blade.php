@include('board.boardTask.components.create_boardTask-modal')
@include('board.boardTask.components.edit_boardTask-modal')

@foreach($boards as $board)
    <div class="col-8 col-sm-6 col-md-5 col-lg-3 card-col" id="board-{{ $board->id }}">
        <div class="card board">
            <div class="card-header">
                <a href="" class="board-title" data-board_id="{{ $board->id }}">{{ $board->title }}</a>
            </div>
            <div class="card-body board-tasks">
                @include('board.boardTask.index')
            </div>
            <div class="card-footer">
                <a href="" class="createBoardTaskBtn" data-board_id="{{ $board->id }}">Добавить задачу</a>
            </div>
        </div>
    </div>
@endforeach
