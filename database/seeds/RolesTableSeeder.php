<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $data = array(
            array('descripcion' => 'Administrador'),
            array('descripcion' => 'Usuario'),
        );

        App\Role::insert($data);
    }
}