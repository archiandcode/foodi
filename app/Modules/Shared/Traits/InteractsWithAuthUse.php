<?php

namespace App\Modules\Shared\Traits;

use App\Modules\Users\Models\User;

trait InteractsWithAuthUse
{
    protected function user(): User
    {
        /** @var User $user */
        $user = auth()->guard('web')->user();

        return $user;
    }
}
