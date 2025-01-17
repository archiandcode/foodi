@extends('layouts.panel')

@section('title', __('Страны'))

@section('content_header')
    {{ __('Страны') }}
@endsection

@section('content')
    @include('admin._components.alert')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <a href="{{ route('admin.countries.create') }}" class="btn btn-success"
                               title="{{ __('Добавить') }}">
                                <i class="fa fa-plus" aria-hidden="true"></i> {{ __('Добавить') }}
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive" id="tblSort">
                            <table id="tblData" class="table table-bordered table-striped dataTable dtr-inline">
                                <thead>
                                <tr>
                                    <th>{{ __('ID') }}</th>
                                    <th>{{ __('Название') }}</th>
                                    <th>{{ __('Действие') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($countries as $country)
                                    <tr>
                                        <td>{{ $country->id }}</td>
                                        <td>{{ $country->name }}</td>
                                        <td>
                                            <a href="{{ route('admin.countries.show', $country) }}"
                                               class="btn btn-info btn-sm mb-2" title="{{ __('Просмотр') }}">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </a>
                                            <a href="{{ route('admin.cities.index', $country) }}"
                                               class="btn btn-warning btn-sm mb-2 "
                                               title="{{ __('Просмотр городов') }}">
                                                <i class="fa fa-city" aria-hidden="true"></i>
                                            </a>

                                            <a href="{{ route('admin.countries.edit', $country) }}"
                                               class="btn btn-primary btn-sm mb-2" title="{{ __('Редактировать') }}">
                                                <i class="fa fa-fw fa-edit" aria-hidden="true"></i>
                                            </a>
                                            <form method="POST"
                                                  action="{{ route('admin.countries.destroy', $country) }}"
                                                  accept-charset="UTF-8" style="display:inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm mb-2"
                                                        title="{{ __('Удалить') }}"
                                                        onclick="return confirm('{{ __('Подтвердите удаление этой страны?') }}')">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td align="center" class="text-danger" colspan="3">
                                            {{ __('Страны не найдены') }}
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>{{ __('ID') }}</th>
                                    <th>{{ __('Название') }}</th>
                                    <th>{{ __('Действие') }}</th>
                                </tr>
                                </tfoot>
                            </table>
                            <div class="pagination-wrapper">
                                {{--                                @if(is_object($countries))--}}
                                {{--                                    {!! $countries->links('admin._components.pagination') !!}--}}
                                {{--                                @endif--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
