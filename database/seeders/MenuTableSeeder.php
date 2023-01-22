<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $listMenu = [
            [
                'id' => 1,
                'name' => 'Dashboard',
                'slug' => 'dashboard',
                'parent_id' => NULL,
                'order' => 1,
                'route' => 'dashboard',
                'icon' => 'fas fa-tachometer',
                'role_id' => 1
            ],
            [
                'id' => 2,
                'name' => 'Dashboard',
                'slug' => 'dashboard',
                'parent_id' => NULL,
                'order' => 1,
                'route' => 'dashboard',
                'icon' => 'fas fa-tachometer',
                'role_id' => 2
            ],
            [
                'id' => 3,
                'name' => 'Dashboard',
                'slug' => 'dashboard',
                'parent_id' => NULL,
                'order' => 1,
                'route' => 'dashboard',
                'icon' => 'fas fa-tachometer',
                'role_id' => 3
            ],
            [
                'id' => 4,
                'name' => 'Manajemen Users',
                'slug' => 'manajemen-user',
                'parent_id' => NULL,
                'order' => 2,
                'route' => 'dashboard',
                'icon' => 'fas fa-tachometer',
                'role_id' => 1
            ],
            [
                'id' => 5,
                'name' => 'Roles',
                'slug' => 'roles',
                'parent_id' => 4,
                'order' => 2,
                'route' => 'dashboard',
                'icon' => 'fas fa-tachometer',
                'role_id' => 1
            ],
            [
                'id' => 6,
                'name' => 'Permissions',
                'slug' => 'permissions',
                'parent_id' => 4,
                'order' => 3,
                'route' => 'dashboard',
                'icon' => 'fas fa-tachometer',
                'role_id' => 1
            ],
            [
                'id' => 7,
                'name' => 'User',
                'slug' => 'user',
                'parent_id' => 4,
                'order' => 3,
                'route' => 'dashboard',
                'icon' => 'fas fa-tachometer',
                'role_id' => 1
            ],
            [
                'id' => 8,
                'name' => 'Rombongan Belajar',
                'slug' => 'user',
                'parent_id' => NULL,
                'order' => 5,
                'route' => 'dashboard',
                'icon' => 'fas fa-tachometer',
                'role_id' => 1
            ],

        ];

        foreach ($listMenu as $menu) {
            Menu::create($menu);
        }
    }
}
