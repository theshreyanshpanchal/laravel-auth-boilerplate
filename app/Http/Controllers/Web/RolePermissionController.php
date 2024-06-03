<?php

namespace App\Http\Controllers\Web;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\RolePermissionRequest;
use App\Services\AccessControlService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionController extends Controller
{
    public $accessControl;

    public function __construct(AccessControlService $accessControl)
    {
        $this->accessControl = $accessControl;
    }

    public function viewRoles(): View
    {
        $roles = Role::query()

            ->select('id', 'display_name', 'name', 'description')

            ->get();

        return view('pages.role-permission.list', compact('roles'));
    }

    public function viewPermissions(int $id): View
    {
        $role = Role::query()

            ->select('id', 'display_name', 'name', 'description')

            ->with('permissions:id,display_name,name,description')

            ->findOrFail($id);

        $permissions = Permission::query()

            ->select('id', 'display_name', 'name', 'description')

            ->get();

        return view('pages.role-permission.permissions', compact('role', 'permissions'));
    }

    public function syncRolePermissions(RolePermissionRequest $request, int $id): RedirectResponse
    {
        $defaultPermission = 'dashboard';

        $newPermissions = $request->permissions ?? [];

        $role = Role::query()->with('permissions')->findOrFail($id);

        if ($role->name !== UserRole::ADMIN->value) {

            if (!in_array($defaultPermission, $newPermissions)) {

                array_push($newPermissions, $defaultPermission);

            }

            $permissions = Permission::whereIn('name', $newPermissions)->get();

            $role->syncPermissions($permissions);

            $this->accessControl->syncRolePermissionsWithUsers($role);

            return redirect()->back()->withSuccess('Permissions updated successfully.');

        } else {

            return redirect()->back()->withErrors([ 'message' => 'Permissions for admin can not be changed.' ]);

        }
    }

}
