<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Create roles with the guard 'web'
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);

        // Define permissions
        $permissions = [
            'create stock',
            'edit stock',
            'delete stock',
            'view details stock',
            'view stock',
            'print qrcode',
            'create role',
            'view role',
            'edit role',
            'delete role',
            'create user',
            'view user',
            'edit user',
            'delete user',
        ];

        // Create permissions with the guard 'web'
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        // Assign all permissions to admin
        $adminRole->syncPermissions(Permission::all());
    }
}
