<form method="POST"
      action="{{ isset($address)
            ? route('admin.addresses.update', $address)
            : route('admin.addresses.store') }}"
      class="form-horizontal">

    @csrf
    @if(isset($address))
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
        <label for="countrySelect">Страна</label>
        <select id="countrySelect" name="country_id" class="form-control" required data-url="{{ route('api.cities.index') }}">
            <option value="">-- {{__('Выберите страну')}} --</option>
        </select>
    </div>

    <div class="form-group mt-2">
        <label for="citySelect">Город</label>
        <select id="citySelect" name="city_id" class="form-control" required>
            <option value="">-- {{ __('Сначала выберите страну') }} --</option>
        </select>
    </div>

    <div class="form-group mt-2">
        <label for="address">Адрес</label>
        <input type="text" name="address" class="form-control"
               value="{{ old('address', $address->address ?? '') }}" required>
    </div>

    <div class="form-group mt-2">
        <label for="description">Описание (необязательно)</label>
        <textarea name="description" class="form-control" rows="3">{{ old('description', $address->description ?? '') }}</textarea>
    </div>

    <div class="form-group mt-3">
        <label>Выберите точку на карте</label>
        <div id="map" style="height: 400px; width: 100%; border: 1px solid #ccc;"></div>

        <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude', $address->latitude ?? '') }}">
        <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude', $address->longitude ?? '') }}">
    </div>


    <div class="form-group mt-3">
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </div>
</form>
