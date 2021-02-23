<div class="boards-row row">
    @foreach($boards as $board)
        <div class="col-8 col-sm-6 col-md-5 col-lg-3 card-col">
            <div class="card board">
                <div class="card-header">
                    <a href="">{{ $board->title }}</a>
                </div>
                <div class="card-body">
                    @include('board.card.index')
                </div>
                <div class="card-footer">
                    <a href="">Добавить задачу</a>
                </div>
            </div>
        </div>
    @endforeach
</div>
