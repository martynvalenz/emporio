<?php

namespace Emporio\Model;

use Illuminate\Database\Eloquent\Model;
use Emporio\Model\Facturas;
use Emporio\Model\Servicios;

class FacturasDetalles extends Model
{
    protected $table='facturas_detalles';

    protected $primaryKey='id';

    public $timestamps=true;

    protected $fillable =
    [
    	'monto',
    	'id_factura',
        'id_servicio',
    	'pagado'
    ];

    protected $guarded =[

    ];

    protected $dates=
    [
        'created_at',
        'updated_at'
    ];

    public function Servicios()
    {
        return $this->belongsTo('Emporio\Model\Servicios', 'id_servicio', 'id');
    }

    public function Facturas()
    {
        return $this->belongsTo('Emporio\Model\Facturas', 'id_factura', 'id');
    }
}
