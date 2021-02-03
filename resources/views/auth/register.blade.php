@extends('layouts.guest')

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/auth.css') }}">
@endsection

@section('content')
<div class="text-center">
    <div class="auth-block">
    <h2 class="mt-5">Регистрация</h2>
        @if ($errors->any())
            <div class="card errors-card">
                <div class="card-body">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="error-text">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
        <form class="auth-form mt-3" action="{{ route('register') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="login">Логин</label>
                <input type="text" class="form-control" id="login" name="login" value="{{ old('login') }}">
            </div>
            <div class="form-group">
                <label for="password">Пароль</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="form-group">
                <label for="password_confirmation">Повтор пароля</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
            </div>
            <button type="submit" class="btn auth-btn">Зарегистрироваться</button>
        </form>
    </div>
</div>
@endsection
