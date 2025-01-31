@extends('layouts.public')

@section('title', __('Вход'))

@section('content')
    <main class="auth-page-wrapper">
        <div class="auth-container">
            <h1 class="title">Регистрация</h1>
            <form action="{{ route('register') }}" method="POST" class="auth-form">
                @csrf
                @method('POST')
                <input type="text" name="name" placeholder="Имя" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Пароль" required>
                <input type="password" name="password_confirmation" placeholder="Подтвердить пароль" required>
                <button type="submit">Зарегистрироваться</button>
            </form>
            <div class="auth-switch">
                <span>Уже есть аккаунт?</span>
                <a href="{{ route('login.form') }}">Войти</a>
            </div>

        </div>
    </main>
@endsection
