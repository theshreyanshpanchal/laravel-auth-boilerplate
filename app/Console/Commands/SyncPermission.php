<?php

namespace App\Console\Commands;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SyncPermission extends Command
{
    protected $signature = 'sync:permission';

    protected $description = 'Command to assign new permissions to admin user';

    public function handle(): void
    {
        $handle = UserRole::ADMIN->value;

        $user = User::role($handle)->first();

        $role = Role::where('name', $handle)->first();

        $permissions = Permission::get();

        if (! empty($role)) { $role->givePermissionTo($permissions); }

        if (! empty($user)) { $user->givePermissionTo($permissions); }

        $this->newLine();

        $this->comment("Permissions synced successfully 🔐.");

        $this->newLine();
    }
}
