<?php

use Illuminate\Database\Seeder;

class CatalogoEstadosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            array('id'=>'A', 'descripcion'=> 'Activo'),
            array('id'=>'D', 'descripcion'=> 'Desactivado'),
            array('id'=>'B', 'descripcion'=> 'Bloqueado'),
        );

        App\CatalogoEstado::Insert($data);//Eloquent
    }
}
