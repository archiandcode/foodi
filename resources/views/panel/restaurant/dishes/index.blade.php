@extends('layouts.panel')

@section('title', __('Блюда'))

@section('content_header')
    {{ __('Блюда') }}
@endsection

@section('content')
    @include('_components.alert')

    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('admin.dishes.create') }}" class="btn btn-success">
                    <i class="fa fa-plus"></i> {{ __('Добавить') }}
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>{{ __('Изображение') }}</th>
                            <th>{{ __('Название') }}</th>
                            <th>{{ __('Цена') }}</th>
                            <th>{{ __('Категория') }}</th>
                            <th>{{ __('Доступно') }}</th>
                            <th>{{ __('Действие') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($dishes as $dish)
                            <tr>
                                <td>{{ $dish->id }}</td>
                                <td style="width: 120px">
                                    @if($dish->image)
                                        <img src="{{ asset('storage/' . $dish->image) }}" alt="image" width="130">
                                    @else
                                        <span class="text-muted">Нет фото</span>
                                    @endif
                                </td>
                                <td>{{ $dish->name }}</td>
                                <td>{{ $dish->price }}</td>
                                <td>{{ $dish->menuCategory->name ?? '-' }}</td>
                                <td>
                                    @if($dish->is_available)
                                        <span class="badge bg-success">Да</span>
                                    @else
                                        <span class="badge bg-danger">Нет</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.dishes.show', $dish) }}" class="btn btn-info btn-sm mb-1">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.dishes.edit', $dish) }}"
                                       class="btn btn-primary btn-sm mb-1">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.dishes.destroy', $dish) }}"
                                          style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm mb-1"
                                                onclick="return confirm('Удалить блюдо?')">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-danger">Блюда не найдены</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
