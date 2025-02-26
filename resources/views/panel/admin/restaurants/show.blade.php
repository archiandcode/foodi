@extends('layouts.panel')

@section('title', __('Просмотр ресторана'))

@section('content_header')
    <h1>{{ __('Просмотр ресторана') }}</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header">
                        <a href="{{ route('admin.restaurants.index') }}" class="btn btn-warning">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i> {{ __('Назад') }}
                        </a>
                        <a href="{{ route('admin.restaurants.edit', $restaurant) }}" class="btn btn-primary">
                            <i class="fa fa-fw fa-edit" aria-hidden="true"></i> {{ __('Редактировать') }}
                        </a>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <th>ID</th>
                                    <td>{{ $restaurant->id }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Название') }}</th>
                                    <td>{{ $restaurant->name }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Slug') }}</th>
                                    <td>{{ $restaurant->slug }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('BIN') }}</th>
                                    <td>{{ $restaurant->bin }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Сайт') }}</th>
                                    <td>
                                        @if($restaurant->website)
                                            <a href="{{ $restaurant->website }}" target="_blank">
                                                {{ $restaurant->website }}
                                            </a>
                                        @else
                                            <span class="text-muted">—</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{ __('Описание') }}</th>
                                    <td>{{ $restaurant->description ?: '—' }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Логотип') }}</th>
                                    <td>
                                        @if($restaurant->logo)
                                            <img src="{{ asset('storage/' . $restaurant->logo) }}" height="80" alt="logo">
                                        @else
                                            <span class="text-muted">—</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{ __('Баннер') }}</th>
                                    <td>
                                        @if($restaurant->banner)
                                            <img src="{{ asset('storage/' . $restaurant->banner) }}" height="120" alt="banner">
                                        @else
                                            <span class="text-muted">—</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{ __('Активен') }}</th>
                                    <td>
                                        @if($restaurant->is_active)
                                            <span class="badge bg-success">Да</span>
                                        @else
                                            <span class="badge bg-secondary">Нет</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{ __('Заблокирован') }}</th>
                                    <td>
                                        @if($restaurant->is_banned)
                                            <span class="badge bg-danger">Да</span>
                                        @else
                                            <span class="badge bg-success">Нет</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{ __('Дата создания') }}</th>
                                    <td>{{ $restaurant->created_at?->format('d.m.Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Дата обновления') }}</th>
                                    <td>{{ $restaurant->updated_at?->format('d.m.Y H:i') }}</td>
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
