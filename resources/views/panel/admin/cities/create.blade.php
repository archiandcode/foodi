@extends('layouts.panel')

@section('title', __('Добавить город'))

@section('content_header')
    <h1>{{ __('Добавить город') }}</h1>
@endsection
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('admin.cities.index', ['country' => $country]) }}" class="btn btn-warning">
                            <i class="fa fa-arrow-left"></i> {{ __('Назад') }}
                        </a>
                    </div>
                    <div class="card-body">

                        @include('panel.admin.cities._form')

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    @include('_components.map-script')
    <script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps_api_key') }}&callback=initMap" async defer></script>

    <script>
        window.initMap = function () {
            initCustomMap('map', 'latitude', 'longitude');
        };
    </script>
@endpush
