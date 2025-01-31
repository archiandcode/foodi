<?php

namespace App\Modules\StaffUser\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|email|unique:users,email,' . $this->user()->id,
            'password' => ['nullable', 'confirmed', 'min:6'],
            'name' => ['required', 'string'],
        ];
    }
}
