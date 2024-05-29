<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role as Model;

class Role extends Seeder
{
    public function run(): void
    {
        DB::beginTransaction();

        $file = app_path('Docs/roles.json');

        if (file_exists($file)) {

            $content = file_get_contents($file);

            $roles = json_decode($content) ?? [];

            if (count($roles)) {

                foreach ($roles as $role) {

                    $name = $role->name;

                    $model = Model::updateOrCreate(
                        [
                            'name' => $name
                        ],
                        [
                            'display_name' => $role->display_name,

                            'description' => $role->description,
                        ]
                    );

                    $permissions = $model->permissions->count();

                    if ($permissions === 0) {

                        $rolePermissions = $role->permissions ?? [];

                        if (count($rolePermissions)) {

                            $availablePermissions = Permission::whereIn('name', $rolePermissions)->get();

                            $model->givePermissionTo($availablePermissions);

                        }
                    }
                }
            }
        }

        DB::commit();

    }
}
