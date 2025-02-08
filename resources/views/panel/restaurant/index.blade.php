@extends('layouts.panel')

@section('title', __('Ресторан'))

@section('content_header')
    <h1>{{ __('Информация о ресторане') }}</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header">
                        <a href="{{ route('admin.restaurant.edit', $restaurant) }}" class="btn btn-primary"
                           title="{{ __('Редактировать') }}">
                            <i class="fa fa-fw fa-edit" aria-hidden="true"></i> {{ __('Редактировать') }}
                        </a>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <th>{{ __('ID') }}</th>
                                    <td>{{ $restaurant->id }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Название') }}</th>
                                    <td>{{ $restaurant->name }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Описание') }}</th>
                                    <td>{{ $restaurant->description ?? '—' }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('BIN') }}</th>
                                    <td>{{ $restaurant->bin }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Сайт') }}</th>
                                    <td>
                                        @if($restaurant->website)
                                            <a href="{{ $restaurant->website }}" target="_blank">{{ $restaurant->website }}</a>
                                        @else
                                            —
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{ __('Логотип') }}</th>
                                    <td>
                                        @if($restaurant->logo)
                                            <img src="{{ asset('storage/' . $restaurant->logo) }}" height="80" alt="logo">
                                        @else
                                            <span class="text-muted">Нет</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{ __('Баннер') }}</th>
                                    <td>
                                        @if($restaurant->banner)
                                            <img src="{{ asset('storage/' . $restaurant->banner) }}" height="120" alt="banner">
                                        @else
                                            <span class="text-muted">Нет</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{ __('Дата регистрации') }}</th>
                                    <td>{{ $restaurant->created_at?->format('d.m.Y') }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
