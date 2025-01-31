@extends('layouts.panel')

@section('title', __('Редактировать страну'))

@section('content_header')
    <h1>{{ __('Редактировать страну') }}</h1>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('admin.countries.index') }}" class="btn btn-warning">
                            <i class="fa fa-arrow-left"></i> {{ __('Назад') }}
                        </a>
                    </div>
                    <div class="card-body">

                        @include('panel.countries._form', ['country' => $country])

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
