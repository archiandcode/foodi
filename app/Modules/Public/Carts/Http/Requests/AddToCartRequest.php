<?php

namespace App\Modules\Public\Carts\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddToCartRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'dish_id' => ['required', 'integer', 'exists:dishes,id'],
        ];
    }
}
