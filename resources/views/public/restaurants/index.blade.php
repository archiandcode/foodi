@extends('layouts.public')

@section('title', 'main')

@section('content')
    <!-- Поисковый блок -->
    <search-block></search-block>

    <!-- Рестораны -->
    <restaurant-list></restaurant-list>

    <!-- Модальное окно -->
    <location-modal></location-modal>
@endsection
