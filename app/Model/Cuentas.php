<?php

namespace Emporio\Model;

use Illuminate\Database\Eloquent\Model;
use Emporio\Model\Bancos;
use Emporio\Model\EstadosCuenta;

class Cuentas extends Model
{
    protected $table='cuentas';

    protected $primaryKey='id';

    protected $fillable =
    [
        'tipo',
        'alias',
        'id_banco',
        'cuenta',
        'clabe',
        'tarjeta',
        'saldo_inicial',
        'comentarios',
        'estatus'
    ];

    protected $guarded =[

    ];

    public function Bancos()
    {
        return $this->hasOne('Emporio\Model\Bancos', 'id', 'id_banco');
    }

    public function EstadosCuenta()
    {
        return $this->hasMany('Emporio\Model\EstadosCuenta', 'id_cuenta', 'id');
    }
}
