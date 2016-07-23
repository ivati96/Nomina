<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            array(
                'name' => 'Iván',
                'last_name' => 'Cadenas',
                'user' => 'sa',
                'email' => 'ivanalirio_@hotmail.com',
                'password' => bcrypt('1234'),
                'role' => '1',
                'estado_id' => 'A',
            ),
            array(
                'name' => 'Darwin',
                'last_name' => 'Cadenas',
                'user' => 'darwin',
                'email' => 'darwinc@hotmail.com',
                'password' => bcrypt('1234'),
                'role' => '2',
                'estado_id' => 'A',
            ),
        );
        
        App\User::Insert($data);
    }
}
