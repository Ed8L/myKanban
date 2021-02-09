@extends('layouts.main')

@section('scripts')
<script src="{{ asset('assets/js/projects.js') }}"></script>
@endsection

@section('content')
@include('projects.create_project')
<div class="container-fluid mt-5">
    <div class="card big-card">
        <div class="card-header big-card__header">
            <div class="big-card__header__title">
                Все проекты
            </div>
            <a class="add_project" data-toggle="modal" data-target="#createProjectModal">
                Добавить проект
            </a>
        </div>
        <div class="card-body">
            <div class="row" id="projects-row">
                @forelse ($projects as $project)
                <div class="col-lg-4 col-md-6">
                    <div class="card project mb-3">
                        <a class="project-title" href="{{ route('project.show', ['project' => $project->id]) }}">
                            <div class="card-body text-center">
                                <p>{{ $project->title }}</p>
                            </div>
                        </a>
                    </div>
                </div>
                @empty
                <div id="empty-message">
                    У вас нет проектов
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
