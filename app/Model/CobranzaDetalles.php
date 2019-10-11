<?php

namespace Emporio\Model;

use Illuminate\Database\Eloquent\Model;
use Emporio\Model\Facturas;
use Emporio\Model\Servicios;
use Emporio\Model\EstadosCuenta;

class CobranzaDetalles extends Model
{
    protected $table='cobranza_detalles';

    protected $primaryKey='id';

    public $timestamps=false;

    protected $fillable =
    [
    	'monto',
    	'id_factura',
    	'id_servicio',
    	'pagado',
    ];

    protected $guarded =[

    ];

    public function Facturas()
    {
        return $this->belongsTo('Emporio\Model\Facturas', 'id_factura', 'id');
    }

    public function EstadosCuenta()
    {
        return $this->belongsTo('Emporio\Model\EstadosCuenta', 'id_cobranza', 'id');
    }
}
