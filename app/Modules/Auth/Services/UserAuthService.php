<?php

namespace App\Modules\Auth\Services;

use App\Modules\Auth\Actions\CreateCartAction;
use App\Modules\Auth\Actions\CreateUserAction;
use App\Modules\Auth\DTOs\LoginUserData;
use App\Modules\Auth\DTOs\RegisterUserData;
use Illuminate\Support\Facades\DB;

class UserAuthService
{
    public function __construct(
        protected CreateUserAction $createUserAction,
        protected CreateCartAction $createCartAction,
    ) {}

    public function register(RegisterUserData $data): void
    {
        DB::transaction(function () use ($data) {
            $user = $this->createUserAction->execute($data);
//            $this->createCartAction->execute($user);
            auth()->guard('web')->login($user);
        });
    }

    public function login(LoginUserData $data): bool
    {
        $success = auth()->guard('web')->attempt([
            'email' => $data->email,
            'password' => $data->password,
        ], true);

        if ($success) {
            session()->regenerate();
        }

        return $success;
    }


    public function logout(): void
    {
        auth()->guard('web')->logout();

        session()->invalidate();
        session()->regenerateToken();
    }
}
