<?php

namespace App\Modules\RestaurantPanel\Dishes\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DishRequest extends FormRequest
{

    public function rules(): array
    {
        return [
                'name' => 'required|string|max:255',
                'price' => 'required|numeric|min:0',
                'image' => 'nullable|image|max:2048',
                'is_available' => 'nullable|boolean',
                'menu_category_id' => 'required|exists:menu_categories,id',
        ];
    }
}
