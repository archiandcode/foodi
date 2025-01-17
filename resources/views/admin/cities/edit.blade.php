@extends('layouts.panel')

@section('title', __('Редактировать город'))

@section('content_header')
    <h1>{{ __('Редактировать город') }}</h1>
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

                        @include('admin.cities._form', ['city' => $city])

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
