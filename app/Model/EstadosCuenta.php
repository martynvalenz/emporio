<?php

namespace Emporio\Model;

use Illuminate\Database\Eloquent\Model;
use Emporio\Model\Proveedores;
use Emporio\Model\Cuentas;
use Emporio\Model\FormasPago;
use Emporio\Model\CategoriaEgresos;
use Emporio\Model\Clientes;
use Emporio\Model\Servicios;
use Emporio\Model\Nomina;

class EstadosCuenta extends Model
{
    protected $table='estados_cuenta';

    protected $primaryKey='id';

    protected $fillable =
    [
    	'tipo',
    	'concepto',
    	'fecha',
    	'con_iva',
    	'folio',
    	'cheque',
    	'movimiento',
    	'subtotal',
    	'porcentaje_iva',
    	'iva',
        'total',
        'deposito',
        'retiro',
    	'restante',
    	'estatus',
    	'id_categoria',
    	'id_forma_pago',
    	'id_cuenta',
    	'id_admin',
    	'id_cliente',
    	'id_razon_social',
    	'id_proveedor',
        'cancelado_at'
    ];

    protected $guarded =[

    ];

    public function Proveedores()
    {
        return $this->belongsTo('Emporio\Model\Proveedores', 'id', 'id_proveedor');
    }

    public function Cuentas()
    {
        return $this->belongsTo('Emporio\Model\Cuentas', 'id', 'id_cuenta');
    }

    public function FormasPago()
    {
        return $this->belongsTo('Emporio\Model\FormasPago', 'id', 'id_forma_pago');
    }

    public function CategoriaEgresos()
    {
        return $this->belongsTo('Emporio\Model\CategoriaEgresos', 'id', 'id_categoria');
    }

    public function Clientes()
    {
        return $this->belongsTo('Emporio\Model\Clientes', 'id', 'id_cliente');
    }

    public function Servicios()
    {
        return $this->belongsTo('Emporio\Model\Servicios', 'id', 'id_servicio');
    }
    public function Nomina()
    {
        return $this->hasMany('Emporio\Model\Nomina', 'id_egreso', 'id');
    }

    public function CobranzaDetalles()
    {
        return $this->belongsToMany('Emporio\Model\CobranzaDetalles', 'id', 'id_cobranza');
    }
}
