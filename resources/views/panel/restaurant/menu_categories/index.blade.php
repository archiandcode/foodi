@extends('layouts.panel')

@section('title', __('Категории меню'))

@section('content_header')
    {{ __('Категории меню') }}
@endsection

@section('content')
    @include('_components.alert')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            @can('create', \App\Modules\RestaurantPanel\Restaurant\Models\MenuCategory::class)
                                <a href="{{ route('admin.menu_categories.create') }}"
                                   class="btn btn-success">
                                    <i class="fa fa-plus"></i> {{ __('Добавить') }}
                                </a>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive" id="tblSort">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>{{ __('ID') }}</th>
                                    <th>{{ __('Название') }}</th>
                                    <th>{{ __('Действие') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($categories as $category)
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>
                                            @can('view', $category)
                                                <a href="{{ route('admin.menu_categories.show', $category) }}"
                                                   class="btn btn-info btn-sm">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            @endcan

                                            @can('update', $category)
                                                <a href="{{ route('admin.menu_categories.edit', $category) }}"
                                                   class="btn btn-primary btn-sm">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            @endcan

                                            @can('delete', $category)
                                                <form method="POST"
                                                      action="{{ route('admin.menu_categories.destroy', $category) }}"
                                                      style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="return confirm('{{ __('Подтвердите удаление категории?') }}')">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            @endcan
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-danger">
                                            {{ __('Категории не найдены') }}
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
