<?php

namespace App\Modules\Public\RestaurantApplication\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RestaurantApplicationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name'        => ['required', 'string', 'max:255'],
            'owner_name'  => ['required', 'string', 'max:255'],
            'email'       => ['required', 'email', 'max:255'],
            'phone'       => ['nullable', 'string', 'max:20'],
            'description' => ['nullable', 'string', 'max:1000'],
            'bin' => ['required', 'string', 'digits:12'],
            'website' => ['nullable', 'url', 'max:255'],
        ];
    }
}
