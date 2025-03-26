@extends('layouts.public')

@section('content')
    <cart-page
        :initial-items='@json($cartItems)'
        csrf="{{ csrf_token() }}"
        :restaurant-slug='@json($restaurant->slug)'
    ></cart-page>
@endsection

@push('scripts')
    <script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps_api_key') }}&callback=initMap" async defer></script>
@endpush
