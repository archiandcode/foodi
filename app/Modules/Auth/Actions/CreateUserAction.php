<?php

namespace App\Modules\Auth\Actions;

use App\Modules\Auth\DTOs\RegisterUserData;
use App\Modules\Users\Models\User;

class CreateUserAction
{
    public function execute(RegisterUserData $data): User
{
        return User::query()->create([
            'name' => $data->name,
            'email' => $data->email,
            'password' => $data->password,
        ]);
    }
}
