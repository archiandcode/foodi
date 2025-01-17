@extends('layouts.panel')

@section('title', 'Добавить блюдо')

@section('content_header')
    <h1>Добавить блюдо</h1>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('restaurant-panel.dishes.index') }}" class="btn btn-warning">
                    <i class="fa fa-arrow-left"></i> Назад
                </a>
            </div>
            <div class="card-body">
                @include('restaurant-panel.dishes._form')
            </div>
        </div>
    </div>
@endsection
