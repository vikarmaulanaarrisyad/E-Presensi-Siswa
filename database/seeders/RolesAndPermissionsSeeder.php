<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions admin
        Permission::create(
            ['name' => 'access-dashboard'],
        );
        Permission::create(
            ['name' => 'access-class'],
        );
        Permission::create(
            ['name' => 'edit-class'],
        );
        Permission::create(
            ['name' => 'show-class'],
        );
        Permission::create(
            ['name' => 'delete-class'],
        );
        Permission::create(
            ['name' => 'access-students'],
        );
        Permission::create(
            ['name' => 'create-students'],
        );
        Permission::create(
            ['name' => 'edit-students'],
        );
        Permission::create(
            ['name' => 'show-students'],
        );
        Permission::create(
            ['name' => 'delete-students'],
        );

        // create roles and assign created permissions
        // this can be done as separate statements
        $roleAdmin = Role::create(['name' => 'admin']);
        $roleGuru = Role::create(['name' => 'guru']);
        $roleSiswa = Role::create(['name' => 'siswa']);
        $roleOrtu = Role::create(['name' => 'ortu']);

        // or may be done by chaining
        $roleAdmin->givePermissionTo(Permission::all());
        $roleGuru->givePermissionTo(['access-dashboard', '']);
        $roleSiswa->givePermissionTo(['access-dashboard', '']);
        $roleOrtu->givePermissionTo(['access-dashboard', '']);
    }
}
