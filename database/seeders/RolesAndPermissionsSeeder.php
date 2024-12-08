<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            'display users',
            'create users',
            'view users',
            'edit users',
            'delete users',
            'manage status users',

            'display prospects',
            'create prospects',
            'view prospects',
            'edit prospects',
            'delete prospects',
            'manage status prospects',

            'display customers',
            'view customers',
            // 'edit customers',
            'delete customers',
            'assign customers',

            'display appointments',
            'create appointments',
            'view appointments',
            'edit appointments',
            'delete appointments',

            'display consultations',
            'create consultations',
            'view consultations',
            'edit consultations',
            'delete consultations',
            'manage confirmation consultations',

            'display ports',
            'create ports',
            'edit ports',
            'delete ports',

            'display shipments',
            'manage status shipments',

            'display equipments',
            'create equipments',
            'edit equipments',
            'delete equipments',

            'display customizations',
            'edit logo customizations',
            'edit name customizations',

            'download reports',

            'display roles',
            'create roles',
            'view roles',
            'edit roles',
            'delete roles',
        ];

        foreach ($permissions as $permission) {
            if (!Permission::where('name', $permission)->exists()) {
                Permission::create(['name' => $permission]);
            }
        }

        // Create roles and assign created permissions
        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo(Permission::all());

        // $role = Role::find(1);
        // $role->update(['name' => 'admin']);
        // $role->syncPermissions(Permission::all());
    }
}
