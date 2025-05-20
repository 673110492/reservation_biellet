<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'view reservations',
            'create reservations',
            'edit reservations',
            'delete reservations',
            'view vehicules',
            'create vehicules',
            'edit vehicules',
            'delete vehicules',
            'view agences',
            'create agences',
            'edit agences',
            'delete agences',
            'view trajets',
            'create trajets',
            'edit trajets',
            'delete trajets',
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
        }

        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminRole->syncPermissions($permissions);
    }
}
