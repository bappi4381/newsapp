<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $permissions = [
            'create-article',
            'edit-article',
            'delete-article',
            'publish-article',
            'manage-users',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $admin  = Role::firstOrCreate(['name' => 'Admin']);
        $editor = Role::firstOrCreate(['name' => 'Editor']);
        $author = Role::firstOrCreate(['name' => 'Author']);

        $admin->givePermissionTo(Permission::all());

        $editor->givePermissionTo([
            'edit-article',
            'publish-article'
        ]);

        $author->givePermissionTo([
            'create-article'
        ]);
    }
}
