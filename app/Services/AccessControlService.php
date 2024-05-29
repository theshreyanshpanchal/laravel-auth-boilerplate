<?php

namespace App\Services;

use App\Models\User;
use Spatie\Permission\Models\Role;

class AccessControlService
{
    public function assignUserRoleWithPermissions(User $user, string $roleName)
    {
        $role = Role::where('name', $roleName)->first();

        $permissions = $role->permissions;

        $user->assignRole($role);

        $user->givePermissionTo($permissions);

        return true;
    }

    public function syncRolePermissionsWithUsers(Role $role)
    {
        $roleName = $role->name;

        $permissions = $role->permissions;

        $users = User::role($roleName)->get();

        if ($users->count()) {
            foreach ($users as $user) {
                $user->syncPermissions($permissions);
            }
        }

        return true;
    }
}
