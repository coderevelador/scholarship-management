<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'logout.perform',
            'roles.index',
            'roles.create',
            'roles.store',
            'roles.show',
            'roles.update',
            'roles.destroy',
            'roles.edit',
            'users.create',
            'users.store',
            'users.show',
            'users.update',
            'users.destroy',
            'users.edit',
            'users.index',
            'permissions.create',
            'permissions.store',
            'permissions.show',
            'permissions.update',
            'permissions.destroy',
            'permissions.edit',
            'permissions.index'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
