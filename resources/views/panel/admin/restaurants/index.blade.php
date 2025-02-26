@extends('layouts.panel')

@section('title', __('Рестораны'))

@section('content_header')
    {{ __('Рестораны') }}
@endsection

@section('content')
    @include('_components.alert')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            {{-- При необходимости: добавить кнопку "Создать" --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive" id="tblSort">
                            <table id="tblData" class="table table-bordered table-striped dataTable dtr-inline">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>{{ __('Название') }}</th>
                                    <th>Slug</th>
                                    <th>BIN</th>
                                    <th>Сайт</th>
                                    <th>Баннер</th>
                                    <th>{{ __('Действие') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($restaurants as $restaurant)
                                    <tr>
                                        <td>{{ $restaurant->id }}</td>
                                        <td>{{ $restaurant->name }}</td>
                                        <td>{{ $restaurant->slug }}</td>
                                        <td>{{ $restaurant->bin }}</td>
                                        <td>
                                            @if($restaurant->website)
                                                <a href="{{ $restaurant->website }}" target="_blank">
                                                    {{ $restaurant->website }}
                                                </a>
                                            @else
                                                <span class="text-muted">—</span>
                                            @endif
                                        </td>
                                        <td>
                                            <img src="{{ $restaurant->banner_url }}"
                                                 alt="banner"
                                                 width="100"
                                                 class="img-thumbnail">
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.restaurants.show', $restaurant) }}"
                                               class="btn btn-info btn-sm mb-2"
                                               title="{{ __('Просмотр') }}">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </a>
                                            <a href="{{ route('admin.restaurants.edit', $restaurant) }}"
                                               class="btn btn-primary btn-sm mb-2"
                                               title="{{ __('Редактировать') }}">
                                                <i class="fa fa-fw fa-edit" aria-hidden="true"></i>
                                            </a>
                                            <form method="POST"
                                                  action="{{ route('admin.restaurants.ban', $restaurant) }}"
                                                  accept-charset="UTF-8"
                                                  style="display:inline">
                                                @csrf
                                                <button type="submit"
                                                        class="btn btn-warning btn-sm mb-2"
                                                        title="{{ __('Заблокировать ресторан') }}"
                                                        onclick="return confirm('{{ __('Вы уверены, что хотите заблокировать этот ресторан?') }}')">
                                                    <i class="fa fa-ban" aria-hidden="true"></i>
                                                </button>
                                            </form>

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td align="center" class="text-danger" colspan="7">
                                            {{ __('Рестораны не найдены') }}
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>{{ __('Название') }}</th>
                                    <th>Slug</th>
                                    <th>BIN</th>
                                    <th>Сайт</th>
                                    <th>Баннер</th>
                                    <th>{{ __('Действие') }}</th>
                                </tr>
                                </tfoot>
                            </table>

                            <div class="pagination-wrapper">
{{--                                {!! $restaurants->links('admin._components.pagination') !!}--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
