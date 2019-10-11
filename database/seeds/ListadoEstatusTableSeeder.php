<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Emporio\Model\ListadoEstatus;

class ListadoEstatusTableSeeder extends Seeder
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
                    'estatus' => 'ABANDONADA',
                    'id_bitacoras_estatus' => '1',
                    'activo' => '1',
                    'color' => '#ED462F',
                    'texto' => '#FFFFFF',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime
                ],
            	[
                    'estatus' => 'CANCELADA',
                    'id_bitacoras_estatus' => '1',
                    'activo' => '1',
                    'color' => '#ED462F',
                    'texto' => '#FFFFFF',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime
                ],
                [
                    'estatus' => 'IMPEDIMENTO',
                    'id_bitacoras_estatus' => '1',
                    'activo' => '1',
                    'color' => '#ED462F',
                    'texto' => '#FFFFFF',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime
                ],
                [
                    'estatus' => 'MONITOREO',
                    'id_bitacoras_estatus' => '1',
                    'activo' => '1',
                    'color' => '#333333',
                    'texto' => '#FFFFFF',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime
                ],
                [
                    'estatus' => 'NEGATIVA',
                    'id_bitacoras_estatus' => '1',
                    'activo' => '1',
                    'color' => '#ED462F',
                    'texto' => '#FFFFFF',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime
                ],
                [
                    'estatus' => 'RENOVAR',
                    'id_bitacoras_estatus' => '1',
                    'activo' => '1',
                    'color' => '#F49831',
                    'texto' => '#333333',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime
                ],
                [
                    'estatus' => 'REQUISITOS',
                    'id_bitacoras_estatus' => '1',
                    'activo' => '1',
                    'color' => '#FDF734',
                    'texto' => '#333333',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime
                ],
                [
                    'estatus' => 'TRÁMITE',
                    'id_bitacoras_estatus' => '1',
                    'activo' => '1',
                    'color' => '#51CCFB',
                    'texto' => '#333333',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime
                ],
                [
                    'estatus' => 'VENCIDA',
                    'id_bitacoras_estatus' => '1',
                    'activo' => '1',
                    'color' => '#ED462F',
                    'texto' => '#FFFFFF',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime
                ],
                [
                    'estatus' => 'VISTO BUENO',
                    'id_bitacoras_estatus' => '1',
                    'activo' => '1',
                    'color' => '#76F013',
                    'texto' => '#FFFFFF',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime
                ],

            );

            ListadoEstatus::insert($data);
    }
}
