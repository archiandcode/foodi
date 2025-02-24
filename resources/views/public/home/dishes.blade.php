@extends('layouts.public')

@section('title', 'main')

@push('styles')
    <style>
        body {
            background-color: #f8f8f8;
        }
    </style>
@endpush

@section('content')
    <dishes-view
        :restaurant='@json($restaurant)'
        :categories='@json($categories)'
        :cart-items='@json($cartItems->values())'
        :is-authenticated='@json(auth()->check())'
        csrf="{{ csrf_token() }}"
    ></dishes-view>
@endsection


@push('scripts')
    <script>
        localStorage.clear();
    </script>
@endpush
