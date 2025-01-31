@extends('layouts.public')

@section('title', __('Вход'))

@section('content')
    <main class="auth-page-wrapper">
        <div class="auth-container">
            <h1 class="title">Вход</h1>
            <form action="{{ route('login') }}" method="POST" class="auth-form">
                @csrf
                @method('POST')
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Пароль" required>

                <button type="submit">Войти</button>
            </form>
            <div class="auth-switch">
                <span>Ещё нет аккаунта?</span>
                <a href="{{ route('register.form') }}">Зарегистрироваться</a>
            </div>
        </div>
    </main>
@endsection
