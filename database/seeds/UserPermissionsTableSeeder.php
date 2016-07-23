<?php

use Illuminate\Database\Seeder;

class UserPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $confirmed = 0;
        $users = App\User::all();
        $menus  = App\Menu::all();

        foreach ($users as $user){
            // Busca por defecto en los permisos de Rol
            $roles  = App\RolePermiso::where('role', '=', $user->role)->get();
            foreach($menus as $menu){
                if ($roles->menu = $menu->id){
                    $confirmed = 1;
                }
                $data = array('user_id' => $user->id, 'menu' => $menu->id, 'confirmed' => $confirmed);
                App\UserPermissions::Create($data);
            }
        }
    }
}
