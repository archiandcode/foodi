<?php

namespace App\Modules\Auth\Http\Requests\User;

use App\Modules\Auth\DTOs\LoginUserData;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email'    => ['required', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    public function getData(): LoginUserData
    {
        return LoginUserData::from($this->validated());
    }
}
