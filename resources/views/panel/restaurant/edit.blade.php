@extends('layouts.panel')

@section('title', __('Редактировать ресторан'))

@section('content_header')
    <h1>{{ __('Редактировать ресторан') }}</h1>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('admin.restaurant.index') }}" class="btn btn-warning">
                    <i class="fa fa-arrow-left"></i> {{ __('Назад') }}
                </a>
            </div>
            <div class="card-body">
                <form method="POST"
                      action="{{ route('admin.restaurant.update', $restaurant) }}"
                      enctype="multipart/form-data"
                      class="form-horizontal">

                    @csrf
                    @method('PUT')

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="form-group mt-2">
                        <label>{{ __('Название') }}</label>
                        <input type="text" class="form-control" value="{{ $restaurant->name }}" readonly>
                        <input type="hidden" name="name" value="{{ $restaurant->name }}">
                    </div>

                    <div class="form-group mt-4">
                        <label for="description">{{ __('Описание') }}</label>
                        <textarea name="description" class="form-control" rows="4">{{ old('description', $restaurant->description) }}</textarea>
                    </div>

                    <div class="form-group mt-2">
                        <label>{{ __('BIN') }}</label>
                        <input type="text" class="form-control" value="{{ $restaurant->bin }}" readonly>
                        <input type="hidden" name="bin" value="{{ $restaurant->bin }}">
                    </div>

                    <div class="form-group mt-2">
                        <label for="website">{{ __('Сайт') }}</label>
                        <input type="text" name="website" class="form-control"
                               value="{{ old('website', $restaurant->website) }}">
                    </div>

                    <div class="form-group mt-2">
                        <label for="logo">{{ __('Логотип') }}</label>
                        <input type="file" name="logo" class="form-control" accept="image/*" onchange="previewImage(event, 'logo-preview')">

                        <div id="logo-preview" class="mt-2">
                            @if($restaurant->logo)
                                <img src="{{ asset('storage/' . $restaurant->logo) }}" class="img-thumbnail" width="150">
                            @endif
                        </div>
                    </div>

                    <div class="form-group mt-2">
                        <label for="banner">{{ __('Баннер') }}</label>
                        <input type="file" name="banner" class="form-control" accept="image/*" onchange="previewImage(event, 'banner-preview')">

                        <div id="banner-preview" class="mt-2">
                            @if($restaurant->banner)
                                <img src="{{ asset('storage/' . $restaurant->banner) }}" class="img-thumbnail" width="300">
                            @endif
                        </div>
                    </div>

                    <div class="form-group mt-4">
                        <button type="submit" class="btn btn-primary">{{ __('Сохранить') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function previewImage(event, targetId) {
            const previewContainer = document.getElementById(targetId);
            previewContainer.innerHTML = '';

            const file = event.target.files[0];
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'img-thumbnail';
                    img.style.width = targetId === 'banner-preview' ? '300px' : '150px';
                    previewContainer.appendChild(img);
                };

                reader.readAsDataURL(file);
            }
        }
    </script>
@endpush
