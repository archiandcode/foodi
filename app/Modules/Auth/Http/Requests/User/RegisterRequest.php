<?php

namespace App\Modules\Auth\Http\Requests\User;

use App\Modules\Auth\DTOs\RegisterUserData;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name'       => ['required', 'string', 'max:255'],
            'email'      => ['required', 'email', 'unique:users,email'],
            'password'   => ['required', 'string', 'min:6', 'confirmed'],
        ];
    }

    public function getData(): RegisterUserData
    {
        return RegisterUserData::from($this->validated());
    }
}
