<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use App\Services\AccessControlService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class Admin extends Seeder
{
    public function run(AccessControlService $accessControl): void
    {
        $role = UserRole::ADMIN->value;

        $admin = User::role($role)->count();

        if (intval($admin) === 0) {

            $user = User::create([

                'first_name' => 'Laravel',

                'last_name' => 'Auth',

                'email' => 'info@laravelauth.com',

                'password' => Hash::make('laravelauth'),

                'email_verified_at' => now()

            ]);

            $accessControl->assignUserRoleWithPermissions($user, $role);
        }
    }
}
