<?php

namespace Emporio\Model;

use Illuminate\Database\Eloquent\Model;

class TarjetasCredito extends Model
{
    protected $table='tarjetas_credito';

    protected $primaryKey='id';

    protected $fillable =
    [
    	'tipo',
    	'fecha',
    	'monto',
    	'pagado',
    	'saldo',
    	'estatus',
    	'pagado_boolean',
    	'id_proveedor',
    	'id_categoria',
    	'id_egreso',
    	'id_cuenta',
    	'id_admin',
    ];

    protected $guarded =[

    ];
}
