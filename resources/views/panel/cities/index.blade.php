@extends('layouts.panel')

@section('title', __('Города'))

@section('content_header')
    {{ __('Города') }}
@endsection

@section('content')
    @include('panel._components.alert')

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

                            @can('create', \App\Modules\Admin\Location\Models\City::class)
                                <a href="{{ route('admin.cities.create', ['country' => $country]) }}" class="btn btn-success"
                                   title="{{ __('Добавить') }}">
                                    <i class="fa fa-plus" aria-hidden="true"></i> {{ __('Добавить') }}
                                </a>
                            @endcan
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
                                @forelse($cities as $city)
                                    <tr>
                                        <td>{{ $city->id }}</td>
                                        <td>{{ $city->name }}</td>
                                        <td>
                                            @can('view', $city)
                                                <a href="{{ route('admin.cities.show', [$country, $city]) }}"
                                                   class="btn btn-info btn-sm mb-2" title="{{ __('Просмотр') }}">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </a>
                                            @endcan

                                            @can('update', $city)
                                                <a href="{{ route('admin.cities.edit', [$country, $city]) }}"
                                                   class="btn btn-primary btn-sm mb-2" title="{{ __('Редактировать') }}">
                                                    <i class="fa fa-fw fa-edit" aria-hidden="true"></i>
                                                </a>
                                            @endcan

                                            @can('delete', $city)
                                                <form method="POST"
                                                      action="{{ route('admin.cities.destroy', [$country, $city]) }}"
                                                      accept-charset="UTF-8" style="display:inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm mb-2"
                                                            title="{{ __('Удалить') }}"
                                                            onclick="return confirm('{{ __('Подтвердите удаление этого города?') }}')">
                                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                                    </button>
                                                </form>
                                            @endcan
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td align="center" class="text-danger" colspan="3">
                                            {{ __('Города не найдены') }}
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
                                {{--                                @if(is_object($cities))--}}
                                {{--                                    {!! $cities->links('admin._components.pagination') !!}--}}
                                {{--                                @endif--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
