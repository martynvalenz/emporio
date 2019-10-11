<?php

namespace Emporio\Model;

use Illuminate\Database\Eloquent\Model;
use Emporio\Model\EstadosCuenta;

class FormasPago extends Model
{
    protected $table='formas_pago';

    protected $primaryKey='id';

    protected $fillable =
    [
    	'codigo',
    	'forma_pago',
        'descripcion',
    	'estatus'
    ];

    protected $guarded =[

    ];

    public function EstadosCuenta()
    {
        return $this->hasMany('Emporio\Model\EstadosCuenta', 'id_forma_pago', 'id');
    }
}
