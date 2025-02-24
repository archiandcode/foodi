<form method="POST"
      action="{{ isset($city) ? route('admin.cities.update', [$country, $city]) : route('admin.cities.store', ['country' => $country]) }}"
      accept-charset="UTF-8"
      class="form-horizontal">

    @csrf
    @method(isset($city) ? 'PUT' : '')

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
        <label for="name">{{ __('Название города') }}</label>
        <input type="text"
               name="name"
               id="name"
               class="form-control @error('name') is-invalid @enderror"
               value="{{ old('name', isset($city) ? $city->name : '') }}">
        @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group mt-3">
        <div class="form-check">
            {{-- Скрытое поле, чтобы при снятии галочки отправлялось "false" --}}
            <input type="hidden" name="is_default" value="0">

            <input type="checkbox"
                   name="is_default"
                   id="is_default"
                   value="1"
                   class="form-check-input"
                {{ old('is_default', $city->is_default ?? false) ? 'checked' : '' }}>
            <label for="is_default" class="form-check-label">
                {{ __('Город по умолчанию') }}
            </label>
        </div>
        @error('is_default')
        <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>


    <div class="form-group mt-3">
        <label>{{__('Выберите точку на карте')}}</label>
        <div id="map" style="height: 400px; width: 100%; border: 1px solid #ccc;"></div>

        <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude', $city->latitude ?? '') }}">
        <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude', $city->longitude ?? '') }}">
    </div>

    <div class="form-group mt-3">
        <button type="submit" class="btn btn-primary">
            {{ __('Сохранить') }}
        </button>
    </div>
</form>
