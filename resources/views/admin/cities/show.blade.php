@extends('layouts.panel')

@section('title', __('Просмотр города'))

@section('content_header')
    <h1>{{ __('Просмотр города') }}</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <a href="{{ route('admin.cities.index', ['country' => $country]) }}" class="btn btn-warning"
                               title="{{ __('Назад') }}">
                                <i class="fa fa-arrow-left" aria-hidden="true"></i> {{ __('Назад') }}
                            </a>
                            <a href="{{ route('admin.cities.edit', [$country, $city]) }}" class="btn btn-primary"
                               title="{{ __('Редактировать') }}">
                                <i class="fa fa-fw fa-edit" aria-hidden="true"></i> {{ __('Редактировать') }}
                            </a>
                            <form method="POST" action="{{ route('admin.cities.destroy', [$country, $city]) }}"
                                  accept-charset="UTF-8" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" title="{{ __('Удалить') }}"
                                        onclick="return confirm('{{ __('Вы уверены, что хотите удалить этот город?') }}')">
                                    <i class="fa fa-trash" aria-hidden="true"></i> {{ __('Удалить') }}
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <th>{{ __('ID') }}</th>
                                    <td>{{ $city->id }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Название') }}</th>
                                    <td>{{ $city->name }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Дата создания') }}</th>
                                    <td>{{ $city->created_at?->format('d.m.Y') }}</td>
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
