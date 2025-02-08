@extends('layouts.panel')

@section('title', __('Добавить категорию'))

@section('content_header')
    <h1>{{ __('Добавить категорию') }}</h1>
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('admin.menu_categories.index') }}"
                           class="btn btn-warning">
                            <i class="fa fa-arrow-left"></i> {{ __('Назад') }}
                        </a>
                    </div>
                    <div class="card-body">

                        @include('panel.restaurant.menu_categories._form')

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
