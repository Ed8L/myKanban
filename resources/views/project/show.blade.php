@extends('layouts.main')

@section('scripts')
    <script src="{{ asset('assets/js/todoTask/index.js') }}"></script>
    <script src="{{ asset('assets/js/board/index.js') }}"></script>
@endsection

@section('content')
    <div class="container-fluid mt-5">
        @include('components.errors')
        @include('components.session-success')

        @include('board.components.create_board-modal')
        @include('board.components.edit_board-modal')

        <div class="d-flex justify-content-between">
            <h3 class="mb-4">{{ $project->title }}</h3>
            <nav class="nav text-right">
                @include('todo.create_or_delete_todolist')
                <a class="nav-link action" href="" data-toggle="modal" data-target="#create_board-modal">Создать доску</a>
            </nav>
        </div>
        <div class="card main-card">
            <div class="card-body">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#todo">ToDo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#boards">Доски</a>
                    </li>
                </ul>

                <div class="tab-content mt-3">
                    <div class="tab-pane active" id="todo">
                        @if(!empty($todo))
                            @include('todo.show')
                        @endif
                    </div>
                    <div class="tab-pane fade" id="boards">
                        @if(!empty($boards))
                            @include('board.index')
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
