@extends('layouts.panel')

@section('title', __('Адреса'))

@section('content_header')
    {{ __('Адреса ресторана') }}
@endsection

@section('content')
    @include('_components.alert')

    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('admin.addresses.create') }}" class="btn btn-success">
                    <i class="fa fa-plus"></i> {{ __('Добавить адрес') }}
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>{{ __('Страна') }}</th>
                            <th>{{ __('Город') }}</th>
                            <th>{{ __('Адрес') }}</th>
                            <th>{{ __('Описание') }}</th>
                            <th>{{ __('Действие') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($addresses as $address)
                            <tr>
                                <td>{{ $address->id }}</td>
                                <td>{{ $address->country->name ?? '-' }}</td>
                                <td>{{ $address->city->name ?? '-' }}</td>
                                <td>{{ $address->address }}</td>
                                <td>{{ $address->description ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('admin.addresses.show', $address) }}"
                                       class="btn btn-info btn-sm mb-1">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.addresses.edit', $address) }}"
                                       class="btn btn-primary btn-sm mb-1">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.addresses.destroy', $address) }}"
                                          style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm mb-1"
                                                onclick="return confirm('Удалить адрес?')">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-danger">Адреса не найдены</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
