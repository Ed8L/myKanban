@extends('layouts.main')

@section('content')
<div class="container-fluid mt-5">
    <div class="card specific-project">
        <div class="card-header">
            <div class="row">
                <div class="col-12 col-sm-7 col-md-8 col-lg-9">
                    {{ $project->title }}
                </div>
                <div class="col-12 col-sm-5 col-md-4 col-lg-3 project-actions">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-secondary mr-3">Добавить ToDo</button>
                        <button type="button" class="btn btn-secondary">Добавить доску</button>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="card-body">
            @if((count($todolist) === 0) && (count($boards) === 0))
                У вас нету ToDo списка или досок
            @else
                @if ($todolist)
                    <div class="card project-listing">
                        <div class="card-header">
                            ToDo List
                        </div>
                        <div class="card-body">
                            ToDo List body
                        </div>
                    </div>
                @endif
                
                @if ($boards)
                    <div class="card project-listing mt-3">
                        <div class="card-header">
                            Boards
                        </div>
                        <div class="card-body">
                            Boards body
                        </div>
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>
@endsection
