<?php

namespace App\Modules\Public\Orders\Http\Requests;

use App\Modules\Public\Orders\DTOs\CreateOrderData;
use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'restaurant_id' => 'required|integer|exists:restaurants,id',
            'total_price' => 'required|numeric|min:0',

            'dishes' => 'required|array|min:1',
            'dishes.*.dish_id' => 'required|integer|exists:dishes,id',
            'dishes.*.quantity' => 'required|integer|min:1',
            'dishes.*.price' => 'required|numeric|min:0',
            'dishes.*.total' => 'required|numeric|min:0',

            'address' => 'required|array',
            'address.note' => 'nullable|string',
            'address.latitude' => 'required|numeric|between:-90,90',
            'address.longitude' => 'required|numeric|between:-180,180',
            'address.city_id' => 'required|integer|exists:cities,id',
        ];
    }

    public function getData(): CreateOrderData
    {
        return CreateOrderData::from($this->validated());
    }
}
