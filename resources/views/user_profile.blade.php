@extends('layouts.main')

@section('content')
    <div class="container-fluid mt-5">
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
               {{ $errors->first() }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="d-flex justify-content-between">
            <h3 class="mb-4">Ваши проекты</h3>
            <nav class="nav text-right">
                <a class="nav-link action" href="#" data-toggle="modal" data-target="#create_project-modal">Добавить
                    проект</a>
            </nav>
        </div>
        @include('project.create_project-modal')
        @include('project.edit_project-modal')
        @include('project.project_listing')
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/project/index.js') }}"></script>
@endsection
