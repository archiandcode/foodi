<?php

namespace App\Modules\Auth\Actions;

use App\Modules\Users\Models\User;

class CreateCartAction
{
    public function execute(User $user)
    {
        return $user->cart()->create();
    }
}
