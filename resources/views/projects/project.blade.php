@extends('layouts.main')

@section('scripts')
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/todo.js') }}"></script>
@endsection

@section('content')
<div class="container-fluid mt-5">
    <div class="card specific-project">
        <div class="card-header">
            <div class="row">
                <div class="col-9">
                    {{ $project->title }}
                </div>
                <div class="col-3 text-right">
                    <button type="button" class="btn btn-primary project-action" data-toggle="modal" data-target="#create-resource">+</button>
                </div>
            </div>
        </div>
        
        <div class="card-body" id="project-body">
            @if((count($todolist) === 0) && (count($boards) === 0))
                В этом проекте нету ToDo списка или досок
            @else
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    @if ((count($todolist) !== 0))
                        <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="todo-tab" data-toggle="tab" href="#todoTabPanel" role="tab" aria-controls="home" aria-selected="true">To Do список</a>
                        </li>
                    @endif

                    @if ((count($boards) !== 0))
                        <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="boards-tab" data-toggle="tab" href="#board" role="tab" aria-controls="home" aria-selected="true">Доски</a>
                        </li>
                    @endif
                </ul>

                <div class="tab-content mt-3" id="myTabContent">
                    @if ((count($todolist) !== 0))
                        <div class="tab-pane fade show active" id="todoTabPanel" role="tabpanel" aria-labelledby="home-tab">
                            <table class="table table-responsive table-dark">
                                <div class="text-right">
                                    <button type="button" class="btn btn-primary mb-2" id="add_todoTask">+</button>
                                    <div class="input-group mb-3 d-none" id="new_todoTask">
                                        <input type="text" class="form-control" id="todoTask" placeholder="Задача">
                                        <button type="submit" class="btn btn-primary ml-2" id="create_todoTask" data-todolist_id="{{ $todolist[0]->id }}">Добавить</button>
                                    </div>
                                </div>
                                <thead>
                                    <tr>
                                        <th scope="col">Задача</th>
                                        <th scope="col">Статус</th>
                                        <th class="text-right" scope="col">Отметить как</th>
                                    </tr>
                                </thead>
                                <tbody id="todo-body">
                                    @foreach($todoListTasks as $task)
                                        <tr>
                                            <td class="text-break">{{ $task->text }}</td>
                                            <td>{{ $task->status }}</td>
                                            <td class="text-right">
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <button type="button" class="btn btn-warning mr-2 taskPending" title="В процессе" data-todolist_id="{{ $todolist[0]->id }}" data-taskid="{{ $task->id }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock-fill" viewBox="0 0 16 16">
                                                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                                                        </svg>
                                                    </button>
                                                    <button type="button" class="btn btn-secondary taskUnfinished mr-2" style="background-color: #3b5360" title="Не выполнено" data-todolist_id="{{ $todolist[0]->id }}" data-taskid="{{ $task->id }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bookmark-dash" viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd" d="M5.5 6.5A.5.5 0 0 1 6 6h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5z"/>
                                                            <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z"/>
                                                        </svg>
                                                    </button>
                                                    <button type="button" class="btn btn-success taskFinished" title="Выполнено" data-todolist_id="{{ $todolist[0]->id }}" data-taskid="{{ $task->id }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2" viewBox="0 0 16 16">
                                                            <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                
                            </table>
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>
@include('components.create-resource')
@endsection
