<form method="POST"
      action="{{ isset($country) ? route('admin.countries.update', $country) : route('admin.countries.store') }}"
      accept-charset="UTF-8"
      class="form-horizontal">

    @csrf
    @method(isset($country) ? 'PUT' : '')

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
        <label for="name">{{ __('Название страны') }}</label>
        <input type="text"
               name="name"
               id="name"
               class="form-control @error('name') is-invalid @enderror"
               value="{{ old('name', isset($country) ? $country->name : '') }}">
        @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group mt-3">
        <label for="code">{{ __('Код страны') }}</label>
        <input type="text"
               name="code"
               id="code"
               class="form-control @error('code') is-invalid @enderror"
               value="{{ old('code', isset($country) ? $country->code : '') }}"
               maxlength="3">
        @error('code')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>


    <div class="form-group mt-3">
        <button type="submit" class="btn btn-primary">
            {{ __('Сохранить') }}
        </button>
    </div>
</form>
