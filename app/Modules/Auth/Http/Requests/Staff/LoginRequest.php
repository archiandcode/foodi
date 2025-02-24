<?php

namespace App\Modules\Auth\Http\Requests\Staff;

use App\Modules\Auth\DTOs\LoginStaffUserData;
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

    public function getData(): LoginStaffUserData
    {
        return LoginStaffUserData::from($this->validated());
    }
}
