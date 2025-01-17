@extends('layouts.panel')

@section('title', __('Просмотр страны'))

@section('content_header')
    <h1>{{ __('Просмотр страны') }}</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <a href="{{ route('admin.countries.index') }}" class="btn btn-warning"
                               title="{{ __('Назад') }}">
                                <i class="fa fa-arrow-left" aria-hidden="true"></i> {{ __('Назад') }}
                            </a>
                            <a href="{{ route('admin.countries.edit', $country) }}" class="btn btn-primary"
                               title="{{ __('Редактировать') }}">
                                <i class="fa fa-fw fa-edit" aria-hidden="true"></i> {{ __('Редактировать') }}
                            </a>
                            <form method="POST" action="{{ route('admin.countries.destroy', $country) }}"
                                  accept-charset="UTF-8" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" title="{{ __('Удалить') }}"
                                        onclick="return confirm('{{ __('Вы уверены, что хотите удалить эту страну?') }}')">
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
                                    <td>{{ $country->id }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Название') }}</th>
                                    <td>{{ $country->name }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Дата создания') }}</th>
                                    <td>{{ $country->created_at?->format('d.m.Y') }}</td>
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
