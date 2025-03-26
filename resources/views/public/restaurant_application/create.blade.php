@extends('layouts.public')

@section('title', __('Отправить заявку'))

@section('content')
    <main class="container my-5">
        <div class="col-lg-6 mx-auto">
            <a href="{{ route('home') }}" class="btn btn-outline-secondary mb-4">
                ← Назад
            </a>

            <section class="card shadow-sm p-4">
                <h1 class="h4 mb-4">Регистрация ресторана</h1>

                <form action="{{ route('restaurant_application.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Название ресторана</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}"
                               placeholder="Введите название"
                               class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="owner_name" class="form-label">Имя владельца</label>
                        <input type="text" id="owner_name" name="owner_name" value="{{ old('owner_name') }}"
                               placeholder="Имя владельца ресторана"
                               class="form-control @error('owner_name') is-invalid @enderror">
                        @error('owner_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                               placeholder="example@email.com"
                               class="form-control @error('email') is-invalid @enderror">
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">Телефон</label>
                        <input type="tel" id="phone" name="phone" value="{{ old('phone') }}"
                               placeholder="+7 777 123 4567"
                               class="form-control @error('phone') is-invalid @enderror">
                        @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="bin" class="form-label">БИН / ИИН</label>
                        <input type="text" id="bin" name="bin" value="{{ old('bin') }}"
                               placeholder="Введите БИН или ИИН"
                               class="form-control @error('bin') is-invalid @enderror">
                        @error('bin')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="website" class="form-label">Веб-сайт (необязательно)</label>
                        <input type="url" id="website" name="website" value="{{ old('website') }}"
                               placeholder="https://example.kz"
                               class="form-control @error('website') is-invalid @enderror">
                        @error('website')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Описание</label>
                        <textarea id="description" name="description" rows="4"
                                  class="form-control @error('description') is-invalid @enderror"
                                  placeholder="Кратко опишите ваш ресторан...">{{ old('description') }}</textarea>
                        @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Отправить заявку</button>
                </form>
            </section>
        </div>
    </main>
@endsection
