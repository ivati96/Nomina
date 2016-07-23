<?php

use Illuminate\Database\Seeder;

class RolePermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menus = App\Menu::all();
        $roles = App\Role::all();

        foreach ($roles as $role){
            foreach($menus as $menu){
                App\RolePermiso::create([
                    'role' => $role->id,
                    'menu' => $menu->id,
                ]);
            }
        }
    }
}