@extends('layouts.panel')

@section('title', __('Просмотр заявки'))

@section('content_header')
    <h1>{{ __('Просмотр заявки на регистрацию ресторана') }}</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header">
                        <a href="{{ route('admin.applications.index') }}" class="btn btn-warning"
                           title="{{ __('Назад') }}">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i> {{ __('Назад') }}
                        </a>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <th>{{ __('ID') }}</th>
                                    <td>{{ $application->id }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Название ресторана') }}</th>
                                    <td>{{ $application->name }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Имя владельца') }}</th>
                                    <td>{{ $application->owner_name }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Email') }}</th>
                                    <td>{{ $application->email }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Телефон') }}</th>
                                    <td>{{ $application->phone ?? '—' }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('БИН / ИИН') }}</th>
                                    <td>{{ $application->bin ?? '—' }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Веб-сайт') }}</th>
                                    <td>
                                        @if ($application->website)
                                            <a href="{{ $application->website }}" target="_blank">
                                                {{ $application->website }}
                                            </a>
                                        @else
                                            —
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{ __('Описание') }}</th>
                                    <td>{{ $application->description ?? '—' }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Статус') }}</th>
                                    <td>
                                        <span class="badge bg-{{ $application->status->value === 'pending' ? 'warning' : ($application->status->value === 'approved' ? 'success' : 'danger') }}">
                                            {{ __($application->status->name) }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{ __('Дата подачи') }}</th>
                                    <td>{{ $application->created_at?->format('d.m.Y H:i') }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    @if($application->status === \App\Modules\Public\Restaurant\Enums\RestaurantApplicationEnum::PENDING)
                        <div class="card-footer">
                            <form method="POST" action="{{ route('admin.applications.approve', $application) }}" style="display:inline">
                                @csrf
                                <button type="submit" class="btn btn-success"
                                        onclick="return confirm('{{ __('Вы уверены, что хотите одобрить эту заявку?') }}')">
                                    <i class="fa fa-check" aria-hidden="true"></i> {{ __('Одобрить') }}
                                </button>
                            </form>

                            <form method="POST" action="{{ route('admin.applications.reject', $application) }}" style="display:inline">
                                @csrf
                                <button type="submit" class="btn btn-secondary"
                                        onclick="return confirm('{{ __('Вы уверены, что хотите отклонить эту заявку?') }}')">
                                    <i class="fa fa-times" aria-hidden="true"></i> {{ __('Отклонить') }}
                                </button>
                            </form>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
