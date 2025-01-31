<?php

namespace App\Console\Commands;

use App\Modules\StaffUser\Enums\RolesEnum;
use App\Modules\StaffUser\Models\Role;
use Illuminate\Console\Command;

class CreateRolesCommand extends Command
{

    protected $signature = 'app:create-roles ';

    protected $description = 'Creates default roles from RolesEnum in the roles table';

    public function handle(): void
    {
        foreach (RolesEnum::cases() as $role) {
            $created = Role::query()->firstOrCreate(['name' => $role->value]);

            if ($created->wasRecentlyCreated) {
                $this->info("Role '{$role->value}' created.");
            } else {
                $this->line("Role '{$role->value}' already exists. Skipped.");
            }
        }
    }
}
