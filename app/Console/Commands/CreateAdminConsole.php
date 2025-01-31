<?php

namespace App\Console\Commands;

use App\Modules\StaffUser\Enums\RolesEnum;
use App\Modules\StaffUser\Models\Role;
use App\Modules\StaffUser\Models\StaffUser;
use Illuminate\Console\Command;

class CreateAdminConsole extends Command
{
    protected $signature = 'app:create-admin';

    protected $description = 'Create admin user command';


    public function handle()
    {
        $name = $this->ask('What is your name?');
        while (true)
        {
            $email = $this->ask('What is your email?');
            if (!StaffUser::query()->where('email', $email)->exists()) {
                break;
            }
            info('User with ' . $email . ' exists.');
        }
        $password = $this->ask('What is your password?');

        $this->call(CreateRolesCommand::class);
        $role = Role::query()->where('name', RolesEnum::Admin)->first();
        $role->users()->create([
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ]);

        info('User created.');
    }
}
