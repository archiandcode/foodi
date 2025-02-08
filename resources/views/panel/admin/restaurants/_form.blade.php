<form method="POST"
      action="{{ isset($restaurant) ? route('admin.restaurants.update', $restaurant) : route('admin.restaurants.store') }}"
      enctype="multipart/form-data"
      accept-charset="UTF-8"
      class="form-horizontal">

    @csrf
    @method(isset($restaurant) ? 'PUT' : '')

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="form-group">
        <label for="name">{{ __('Название ресторана') }}</label>
        <input type="text"
               name="name"
               id="name"
               class="form-control @error('name') is-invalid @enderror"
               value="{{ old('name', $restaurant->name ?? '') }}">
        @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group mt-3">
        <label for="description">{{ __('Описание') }}</label>
        <textarea name="description" id="description" rows="3"
                  class="form-control @error('description') is-invalid @enderror">{{ old('description', $restaurant->description ?? '') }}</textarea>
        @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group mt-3">
        <label for="logo">{{ __('Логотип') }}</label>
        <input type="file" name="logo" id="logo" class="form-control @error('logo') is-invalid @enderror">
        @error('logo')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group mt-3">
        <label for="banner">{{ __('Баннер') }}</label>
        <input type="file" name="banner" id="banner" class="form-control @error('banner') is-invalid @enderror">
        @error('banner')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group mt-4">
        <button type="submit" class="btn btn-primary">
            {{ __('Сохранить') }}
        </button>
    </div>
</form>
