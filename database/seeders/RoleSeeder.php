<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::create(['name' => 'admin']);
        $reception = Role::create(['name' => 'reception']);
        $secure_man = Role::create(['name' => 'secure-man']);


        Permission::create(['name' => 'add-place']);
        Permission::create(['name' => 'edit-place']);
        Permission::create(['name' => 'delete-place']);


        Permission::create(['name' => 'add-room']);
        Permission::create(['name' => 'edit-room']);
        Permission::create(['name' => 'delete-room']);


        Permission::create(['name' => 'add-bed']);
        Permission::create(['name' => 'edit-bed']);
        Permission::create(['name' => 'delete-bed']);

        Permission::create(['name' => 'add-group']);
        Permission::create(['name' => 'edit-group']);
        Permission::create(['name' => 'delete-group']);

        Permission::create(['name' => 'reception']);
        Permission::create(['name' => 'clearance']);

        Permission::create(['name' => 'add-servant']);
        Permission::create(['name' => 'edit-servant']);
        Permission::create(['name' => 'delete-servant']);
        Permission::create(['name' => 'reception-servant']);

        Permission::create(['name' => 'check-reception']);

        $admin->syncPermissions([
            'add-place',
            'edit-place',
            'delete-place',
            'add-room',
            'edit-room',
            'delete-room',
            'add-bed',
            'edit-bed',
            'delete-bed',
            'reception',
            'clearance',
            'check-reception',
            'add-servant',
            'edit-servant',
            'delete-servant',
            'reception-servant',
            'add-group',
            'edit-group',
            'delete-group',
        ]);

        $reception->syncPermissions([
            'edit-place',
            'edit-room',
            'edit-bed',
            'reception',
            'clearance',
            'check-reception',
            'reception-servant',
            'add-group',
            'edit-group',
            'delete-group',
        ]);

        $secure_man->syncPermissions([
            'check-reception'
        ]);

    }
}
