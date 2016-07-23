<?php

use Illuminate\Database\Seeder;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
                array('descripcion'=>'Administración', 'modulo' => '','ruta'=> '#'),
                    array('descripcion'=>'Usuarios', 'modulo' => 'Administración', 'ruta'=> 'users'),
                    array('descripcion'=>'Nómina de sueldos', 'modulo' => 'Administración', 'ruta'=> 'payroll'),
        );

        App\Menu::insert($data);//Eloquent
    }
}
