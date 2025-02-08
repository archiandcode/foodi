<?php

namespace App\Modules\Api\Location\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterAddressRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'latitude'            => 'required|numeric|between:-90,90',
            'longitude'           => 'required|numeric|between:-180,180',
        ];
    }
}
