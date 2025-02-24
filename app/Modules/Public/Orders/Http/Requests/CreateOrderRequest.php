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
        ];
    }

    public function getData(): CreateOrderData
    {
        return CreateOrderData::from($this->validated());
    }
}
