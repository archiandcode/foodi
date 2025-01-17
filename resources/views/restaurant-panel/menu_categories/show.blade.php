@extends('layouts.panel')

@section('title', __('Просмотр категории'))

@section('content_header')
    <h1>{{ __('Просмотр категории') }}</h1>
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('restaurant-panel.menu_categories.index') }}"
                           class="btn btn-warning">
                            <i class="fa fa-arrow-left"></i> {{ __('Назад') }}
                        </a>
                    </div>
                    <div class="card-body">

                        <dl class="row">
                            <dt class="col-sm-3">{{ __('ID') }}</dt>
                            <dd class="col-sm-9">{{ $menuCategory->id }}</dd>

                            <dt class="col-sm-3">{{ __('Название') }}</dt>
                            <dd class="col-sm-9">{{ $menuCategory->name }}</dd>
                        </dl>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
