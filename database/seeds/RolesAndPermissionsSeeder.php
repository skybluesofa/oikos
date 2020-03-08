<?php
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create posts permissions
        Permission::create(['name' => 'add posts']);
        Permission::create(['name' => 'edit posts']);
        Permission::create(['name' => 'delete posts']);
        Permission::create(['name' => 'publish posts']);
        Permission::create(['name' => 'unpublish posts']);

        // create user permissions
        Permission::create(['name' => 'view self user']);
        Permission::create(['name' => 'edit self user']);

        Permission::create(['name' => 'view other users']);
        Permission::create(['name' => 'edit other users']);
        Permission::create(['name' => 'delete other users']);

        Role::create(['name' => 'web author'])
            ->givePermissionTo(['add posts', 'edit posts', 'delete posts', 'publish posts', 'unpublish posts'])
            ->givePermissionTo(['view self user', 'edit self user', 'view other users']);

        Role::create(['name' => 'super-admin'])
            ->givePermissionTo(Permission::all());
    }
}
