<form method="POST"
      action="{{ isset($dish) ?
            route('admin.dishes.update', $dish) :
            route('admin.dishes.store') }}"
      enctype="multipart/form-data"
      class="form-horizontal">

    @csrf
    @if(isset($dish))
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
        <label for="name">Название блюда</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $dish->name ?? '') }}">
    </div>

    <div class="form-group mt-2">
        <label for="price">Цена</label>
        <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price', $dish->price ?? '') }}">
    </div>

    <div class="form-group mt-2">
        <label for="menu_category_id">Категория</label>
        <select name="menu_category_id" class="form-control">
            <option value="">-- Выберите --</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}"
                    {{ old('menu_category_id', $dish->menu_category_id ?? '') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group mt-2">
        <label for="is_available">Доступно</label>
        <select name="is_available" class="form-control">
            <option value="1" {{ old('is_available', $dish->is_available ?? true) ? 'selected' : '' }}>Да</option>
            <option value="0" {{ old('is_available', $dish->is_available ?? true) ? '' : 'selected' }}>Нет</option>
        </select>
    </div>

    <div class="form-group mt-2">
        <label for="image">Изображение</label>
        <input type="file" name="image" class="form-control" accept="image/*" onchange="previewImage(event)">

        <div id="image-preview" class="mt-2">
            @if(!empty($dish->image))
                <img src="{{ asset('storage/' . $dish->image) }}" class="img-thumbnail" width="300" alt="{{ $dish->name }}">
            @endif
        </div>
    </div>


    <div class="form-group mt-3">
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </div>
</form>
