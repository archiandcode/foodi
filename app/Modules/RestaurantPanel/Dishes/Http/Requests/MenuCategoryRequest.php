<?php

namespace App\Modules\RestaurantPanel\Dishes\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuCategoryRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
        ];
    }
}
