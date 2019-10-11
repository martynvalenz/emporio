<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Emporio\User;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array
    	(
            [
                'iniciales' => 'AP',
                'nombre' => 'Allan José',
                'apellido' => 'Parra Vargas',
                'usuario' => 'Allan Parra',
                'email' => 'direccion@marcasyfranquicias.org',
                'password' => \Hash::make('emporio'),
                'contra' => 'emporio',
                'rfc' => '',
                'imss' => '',
                'calle' => '',
                'numero' => '',
                'numero_int' => '',
                'colonia' => '',
                'cp' => '',
                'localidad' => 'Chihuahua',
                'municipio' => 'Chihuahua',
                'id_estado' => '6',
                'id_pais' => '1',
                'telefono' => '',
                'oficina' => '',
                'celular' => '(614)161-4143',
                'estatus' => 1,
                'imagen' => 'allan_parra.jpg',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],

            [
                'iniciales' => 'MV',
                'nombre' => 'Martin',
                'apellido' => 'Valenzuela',
                'usuario' => 'Martin Valenzuela',
                'email' => 'martynvalenz@gmail.com',
                'password' => \Hash::make('martin'),
                'contra' => 'martin',
                'rfc' => 'VAMM870119CA3',
                'imss' => '',
                'calle' => 'Porticos de Batian',
                'numero' => '4811',
                'numero_int' => '',
                'colonia' => 'Porticos de Bella Cumbre',
                'cp' => '31370',
                'localidad' => 'Chihuahua',
                'municipio' => 'Chihuahua',
                'id_estado' => '6',
                'id_pais' => '1',
                'telefono' => '(614)688-2572',
                'oficina' => '',
                'celular' => '(614)358-7697',
                'estatus' => 1,
                'imagen' => 'mv.jpg',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],
    	);

    	User::insert($data);
    }
}
