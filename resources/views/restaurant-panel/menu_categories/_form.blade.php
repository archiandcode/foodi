<form method="POST"
      action="{{ isset($menuCategory)
            ? route('restaurant-panel.menu_categories.update', $menuCategory)
            : route('restaurant-panel.menu_categories.store') }}"
      class="form-horizontal">

    @csrf
    @if(isset($menuCategory))
        @method('PUT')
    @endif

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
        <label for="name">{{ __('Название категории') }}</label>
        <input type="text"
               name="name"
               id="name"
               class="form-control @error('name') is-invalid @enderror"
               value="{{ old('name', isset($menuCategory) ? $menuCategory->name : '') }}">
        @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group mt-3">
        <button type="submit" class="btn btn-primary">
            {{ __('Сохранить') }}
        </button>
    </div>
</form>
