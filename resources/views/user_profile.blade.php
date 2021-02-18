@extends('layouts.main')

@section('content')
    <div class="container-fluid mt-5">
        @include('components.errors')
        @include('components.session-success')

        <div class="d-flex justify-content-between">
            <h3 class="mb-4">Ваши проекты</h3>
            <nav class="nav text-right">
                <a class="nav-link action" href="#" data-toggle="modal" data-target="#create_project-modal">Добавить
                    проект</a>
            </nav>
        </div>
        @include('project.components.create_project-modal')
        @include('project.components.edit_project-modal')
        @include('project.index')
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/project/index.js') }}"></script>
@endsection
