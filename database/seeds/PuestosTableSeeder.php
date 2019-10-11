<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Caffeinated\Shinobi\Models\Role;

class PuestosTableSeeder extends Seeder
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
                'name' => 'Director General',
                'slug' => 'director-general',
                //'estatus' =>1,
                //'special' => 'all-access',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],

    		[
                'name' => 'Desarrollador Web',
    			'slug' => 'desarrollador-web',
    			//'estatus' =>1,
                //'special' => 'all-access',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
    		],

            [
                'name' => 'Administración',
                'slug' => 'administracion',
                //'estatus' =>1,
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],

            [
                'name' => 'Gerente Jurídico',
                'slug' => 'gerente-juridico',
                //'estatus' =>1,
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],

            [
                'name' => 'Asistente Jurídico',
                'slug' => 'asistente-juridico',
                //'estatus' =>1,
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],

            [
                'name' => 'Gerente de Operaciones',
                'slug' => 'gerente-operaciones',
                //'estatus' =>1,
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],

            [
                'name' => 'Relaciones Públicas',
                'slug' => 'relaciones-publicas',
                //'estatus' =>1,
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],

            [
                'name' => 'Auditoría',
                'slug' => 'auditoria',
                //'estatus' =>1,
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],

            [
                'name' => 'Ejecutivo de Ventas',
                'slug' => 'ejecutivo-ventas',
                //'estatus' =>1,
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],

            [
                'name' => 'Operaciones',
                'slug' => 'operaciones',
                //'estatus' =>1,
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],

            [
                'name' => 'Gerente Comercial',
                'slug' => 'gerente-comercial',
                //'estatus' =>1,
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],

            [
                'name' => 'Asesor Comercial',
                'slug' => 'asesor-comercial',
                //'estatus' =>1,
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],
            
    	);

    	Role::insert($data);
    }
}
