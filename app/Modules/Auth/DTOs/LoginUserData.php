<?php

namespace App\Modules\Auth\DTOs;

use Spatie\LaravelData\Data;

class LoginUserData extends Data
{
    public function __construct(
        public string $email,
        public string $password,
    ){}
}
