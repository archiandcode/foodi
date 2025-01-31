@extends('layouts.panel')

@section('title', __('Заявки на регистрацию'))

@section('content_header')
    {{ __('Заявки на регистрацию ресторанов') }}
@endsection

@section('content')
    @include('panel._components.alert')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{-- Фильтры --}}
                        <form method="GET" action="{{ route('admin.applications.index') }}">
                            <div class="row align-items-center">
                                {{-- Сортировка --}}
                                <div class="col-auto">
                                    <select name="sort" class="form-control form-control-sm">
                                        <option value="desc" {{ request('sort', 'desc') === 'desc' ? 'selected' : '' }}>Сначала новые</option>
                                        <option value="asc" {{ request('sort') === 'asc' ? 'selected' : '' }}>Сначала старые</option>
                                    </select>
                                </div>

                                {{-- Статус --}}
                                <div class="col-auto">
                                    <select name="status" class="form-control form-control-sm">
                                        <option value="">Все статусы</option>
                                        @foreach($statuses as $statusEnum)
                                            <option value="{{ $statusEnum->value }}" {{ request('status') === $statusEnum->value ? 'selected' : '' }}>
                                                {{ $statusEnum->labels() }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Кнопка --}}
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-body">

                        {{-- Таблица --}}
                        <div class="table-responsive" id="tblSort">
                            <table id="tblData" class="table table-bordered table-striped dataTable dtr-inline">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>{{ __('Название') }}</th>
                                    <th>{{ __('Владелец') }}</th>
                                    <th>{{ __('Email') }}</th>
                                    <th>{{ __('Статус') }}</th>
                                    <th>{{ __('Действие') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($applications as $application)
                                    <tr>
                                        <td>{{ $application->id }}</td>
                                        <td>{{ $application->name }}</td>
                                        <td>{{ $application->owner_name }}</td>
                                        <td>{{ $application->email }}</td>
                                        <td>
                                            <span class="badge bg-{{ $application->status->badgeColor() }}">
                                                {{ $application->status->labels() }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.applications.show', $application) }}"
                                               class="btn btn-info btn-sm В" title="{{ __('Просмотр') }}">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </a>

                                            @if($application->status === \App\Modules\Public\RestaurantApplication\Enums\RestaurantApplicationEnum::Pending)
                                                <form method="POST" action="{{ route('admin.applications.approve', $application) }}" class="d-inline-block me-1 mb-1">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success btn-sm"
                                                            title="{{ __('Одобрить') }}"
                                                            onclick="return confirm('{{ __('Подтвердите одобрение заявки?') }}')">
                                                        <i class="fa fa-check"></i>
                                                    </button>
                                                </form>

                                                <form method="POST" action="{{ route('admin.applications.reject', $application) }}" class="d-inline-block mb-1">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                            title="{{ __('Отклонить') }}"
                                                            onclick="return confirm('{{ __('Подтвердите отклонение заявки?') }}')">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-danger">
                                            {{ __('Заявки не найдены') }}
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>{{ __('Название') }}</th>
                                    <th>{{ __('Владелец') }}</th>
                                    <th>{{ __('Email') }}</th>
                                    <th>{{ __('Статус') }}</th>
                                    <th>{{ __('Действие') }}</th>
                                </tr>
                                </tfoot>
                            </table>

                            {{-- Пагинация --}}
                            @if(is_object($applications))
                                {!! $applications->appends(request()->query())->links('panel._components.pagination') !!}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
