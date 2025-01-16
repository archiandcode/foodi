<?php

namespace App\Modules\Location\Http\Requests;

use App\Modules\Location\Data\CityData;
use Illuminate\Foundation\Http\FormRequest;
use Spatie\LaravelData\Contracts\BaseData;

class CityRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100'],
        ];
    }
}
