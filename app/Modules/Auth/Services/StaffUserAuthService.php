<?php

namespace App\Modules\Auth\Services;

use App\Modules\Auth\DTOs\LoginStaffUserData;

class StaffUserAuthService
{
    public function login(LoginStaffUserData $data): bool
    {
        $success = auth()->guard('staff')->attempt([
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
        auth()->guard('staff')->logout();
        session()->invalidate();
        session()->regenerateToken();
    }
}
