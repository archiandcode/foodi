@extends('layouts.panel')

@section('title', 'Редактировать блюдо')

@section('content_header')
    <h1>Редактировать блюдо</h1>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('admin.dishes.index') }}" class="btn btn-warning">
                    <i class="fa fa-arrow-left"></i> Назад
                </a>
            </div>
            <div class="card-body">
                @include('panel.restaurant.dishes._form', ['dish' => $dish])
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function previewImage(event) {
            const previewContainer = document.getElementById('image-preview');
            previewContainer.innerHTML = ''; // Очистить предыдущий preview

            const file = event.target.files[0];
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'img-thumbnail';
                    img.style.width = '150px';
                    previewContainer.appendChild(img);
                };

                reader.readAsDataURL(file);
            }
        }
    </script>
@endpush
