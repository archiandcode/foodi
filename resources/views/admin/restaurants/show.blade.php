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
                        <a href="{{ route('admin.restaurants.index') }}" class="btn btn-warning"
                           title="{{ __('Назад') }}">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i> {{ __('Назад') }}
                        </a>
                        <a href="{{ route('admin.restaurants.edit', $restaurant) }}" class="btn btn-primary"
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
                                    <td>{{ $restaurant->description }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Логотип') }}</th>
                                    <td>
                                        @if($restaurant->logo)
                                            <img src="{{ asset('storage/' . $restaurant->logo) }}" height="80"
                                                 alt="logo">
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{ __('Баннер') }}</th>
                                    <td>
                                        @if($restaurant->banner)
                                            <img src="{{ asset('storage/' . $restaurant->banner) }}" height="120"
                                                 alt="banner">
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{ __('Статус') }}</th>
                                    <td>{{ ucfirst($restaurant->status) }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Дата создания') }}</th>
                                    <td>{{ $restaurant->created_at?->format('d.m.Y') }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card-footer">
                        @if(!$restaurant->is_accepted)
                            <form method="POST" action="{{ route('admin.restaurants.accept', $restaurant) }}"
                                  style="display:inline">
                                @csrf
                                <button type="submit" class="btn btn-success" title="{{ __('Принять') }}"
                                        onclick="return confirm('{{ __('Вы уверены, что хотите принять этот ресторан?') }}')">
                                    <i class="fa fa-check" aria-hidden="true"></i> {{ __('Принять') }}
                                </button>
                            </form>

                            <form method="POST" action="{{ route('admin.restaurants.reject', $restaurant) }}"
                                  style="display:inline">
                                @csrf
                                <button type="submit" class="btn btn-secondary" title="{{ __('Отклонить') }}"
                                        onclick="return confirm('{{ __('Вы уверены, что хотите отклонить этот ресторан?') }}')">
                                    <i class="fa fa-times" aria-hidden="true"></i> {{ __('Отклонить') }}
                                </button>
                            </form>
                        @endif

                        @if($restaurant->is_accepted)
                            <form method="POST" action="{{ route('admin.restaurants.ban', $restaurant) }}"
                                  style="display:inline">
                                @csrf
                                <button type="submit" class="btn btn-danger" title="{{ __('Удалить') }}"
                                        onclick="return confirm('{{ __('Вы уверены, что хотите удалить (забанить) этот ресторан?') }}')">
                                    <i class="fa fa-trash" aria-hidden="true"></i> {{ __('Удалить') }}
                                </button>
                            </form>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
