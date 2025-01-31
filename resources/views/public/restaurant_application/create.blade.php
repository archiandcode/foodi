@extends('layouts.public')

@section('title', __('Отправить заявку'))

@section('content')
    <main class="restaurant-register-page">
        <a href="{{ route('home') }}" class="back-button">← Назад</a>

        <section class="restaurant-register-form">
            <h1>Регистрация ресторана</h1>

            <form action="{{ route('restaurant_application.store') }}" method="POST">
                @csrf

                {{-- Название ресторана --}}
                <div class="restaurant-register-row">
                    <label for="name">Название ресторана</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                           placeholder="Введите название"
                           class="@error('name') input-error @enderror">
                    @error('name')
                    <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Имя владельца --}}
                <div class="restaurant-register-row">
                    <label for="owner_name">Имя владельца</label>
                    <input type="text" id="owner_name" name="owner_name" value="{{ old('owner_name') }}"
                           placeholder="Имя владельца ресторана"
                           class="@error('owner_name') input-error @enderror">
                    @error('owner_name')
                    <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="restaurant-register-row">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                           placeholder="example@email.com"
                           class="@error('email') input-error @enderror">
                    @error('email')
                    <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Телефон --}}
                <div class="restaurant-register-row">
                    <label for="phone">Телефон</label>
                    <input type="tel" id="phone" name="phone" value="{{ old('phone') }}"
                           placeholder="+7 777 123 4567"
                           class="@error('phone') input-error @enderror">
                    @error('phone')
                    <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                {{-- ИИН/BIN --}}
                <div class="restaurant-register-row">
                    <label for="bin">БИН / ИИН</label>
                    <input type="text" id="bin" name="bin" value="{{ old('owner_name') }}"
                           placeholder="Введите БИН или ИИН"
                           class="@error('bin') input-error @enderror">
                    @error('bin')
                    <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Веб-сайт --}}
                <div class="restaurant-register-row">
                    <label for="website">Веб-сайт (необязательно)</label>
                    <input type="url" id="website" name="website" value="{{ old('website') }}"
                           placeholder="https://example.kz"
                           class="@error('website') input-error @enderror">
                    @error('website')
                    <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Описание --}}
                <div class="restaurant-register-row">
                    <label for="description">Описание</label>
                    <textarea id="description" name="description" rows="4"
                              class="@error('description') input-error @enderror"
                              placeholder="Кратко опишите ваш ресторан...">{{ old('description') }}</textarea>
                    @error('description')
                    <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit">Зарегистрировать ресторан</button>
            </form>
        </section>
    </main>
@endsection
