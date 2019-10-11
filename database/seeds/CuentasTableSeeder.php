<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Emporio\Model\Cuentas;

class CuentasTableSeeder extends Seeder
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
                    'alias' => 'Efectivo',
                    'tipo' => 'Efectivo',
                    'id_banco' => '1',
                    'saldo_inicial' => 0,
                    'estatus' => 1,
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime
                ],
                [
                    'alias' => 'Bancomer',
                    'tipo' => 'Empresarial',
                    'id_banco' => '2',
                    'saldo_inicial' => 0,
                    'estatus' => 1,
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime
                ],
                [
                    'alias' => 'HSBC',
                    'tipo' => 'Empresarial',
                    'id_banco' => '6',
                    'saldo_inicial' => 0,
                    'estatus' => 1,
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime
                ],
                [
                    'alias' => 'Banamex',
                    'tipo' => 'Empresarial',
                    'id_banco' => '3',
                    'saldo_inicial' => 0,
                    'estatus' => 1,
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime
                ],
                [
                    'alias' => 'Santander',
                    'tipo' => 'Empresarial',
                    'id_banco' => '5',
                    'saldo_inicial' => 0,
                    'estatus' => 1,
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime
                ]
            );

            Cuentas::insert($data);
    }
}
