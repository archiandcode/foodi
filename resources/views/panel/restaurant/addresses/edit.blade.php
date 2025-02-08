@extends('layouts.panel')

@section('title', 'Редактировать адрес')

@section('content_header')
    <h1>Редактировать адрес</h1>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('admin.addresses.index') }}" class="btn btn-warning">
                    <i class="fa fa-arrow-left"></i> Назад
                </a>
            </div>
            <div class="card-body">
                @include('panel.restaurant.addresses.includes._form')
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @include('panel.restaurant.addresses.includes._country-city-loader')
    @include('_components.map-script')
    <script
        src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps_api_key') }}&callback=initMap"
        async defer></script>
    <script>
        window.initMap = function () {
            initCustomMap('map', 'latitude', 'longitude');
        };
    </script>
@endpush
