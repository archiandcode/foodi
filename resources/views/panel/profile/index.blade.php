@extends('layouts.panel')

@section('title', __('Редактирование профиля'))

@section('content_header')
    <h1>Редактирование профиля</h1>
@stop

@section('content')
    @include('_components.alert')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Обновление данных</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name">Имя</label>
                            <input type="text" id="name" name="name" class="form-control"
                                   value="{{ auth()->user()->name }}" required>
                        </div>


                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control"
                                   value="{{ auth()->user()->email }}" required>
                        </div>

                        <div class="form-group">
                            <label for="password">Новый пароль</label>
                            <input type="password" id="password" name="password" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">Подтверждение пароля</label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                   class="form-control">
                        </div>

                        <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
