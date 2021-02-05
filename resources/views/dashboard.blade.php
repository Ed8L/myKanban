@extends('layouts.main')

@section('content')
<div class="container-fluid mt-5">
    <div class="card big-card">
        <div class="card-header big-card__header">
            <div class="big-card__header__title">
                Все проекты
            </div>
            <a href="" class="add_project">
                Добавить проект
            </a>
        </div>
        <div class="card-body">
            <div class="row">
                @for ($i = 0; $i < 7; $i++) <div class="col-lg-4 col-md-6">
                    <div class="card project mb-3">
                        <div class="card-body">
                            <a class="project-title" href="">Project name</a>
                        </div>
                    </div>
            </div>
            @endfor
        </div>


    </div>
</div>
</div>
@endsection
