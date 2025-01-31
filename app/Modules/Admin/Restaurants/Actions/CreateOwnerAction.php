<?php

namespace App\Modules\Admin\Restaurants\Actions;

use App\Modules\Admin\Restaurants\DTOs\OwnerData;
use App\Modules\StaffUser\Enums\RolesEnum;
use App\Modules\StaffUser\Models\Role;

class CreateOwnerAction
{
    public function execute(OwnerData $data)
    {
        $role = Role::query()->where('name', RolesEnum::Owner->value)->first();
        return $role->users()->create([
            'name' => $data->name,
            'email' => $data->email,
            'password' => $data->password,
            'temp_password' => $data->temp_password,
            'restaurant_id' => $data->restaurant_id,
        ]);
    }
}
