<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission as Model;

class Permission extends Seeder
{
    public function run(): void
    {
        DB::beginTransaction();

        $file = app_path('Docs/permissions.json');

        if (file_exists($file)) {

            $content = file_get_contents($file);

            $permissions = json_decode($content) ?? [];

            if (count($permissions)) {

                foreach ($permissions as $permission) {

                    Model::updateOrCreate(
                        [
                            'name' => $permission->name
                        ], [
                            'display_name' => $permission->display_name,

                            'description' => $permission->description
                        ]
                    );
                }
            }
        }

        DB::commit();
    }
}
