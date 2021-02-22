@extends('layouts.main')

@section('scripts')
    <script src="{{ asset('assets/js/todoTask/index.js') }}"></script>
@endsection

@section('content')
    <div class="container-fluid mt-5">
        @include('components.errors')
        @include('components.session-success')
        <div class="d-flex justify-content-between">
            <h3 class="mb-4">{{ $project->title }}</h3>
            <nav class="nav text-right">
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
                <a class="nav-link action" href="#">Создать доску</a>
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
                        @include('board.index')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
